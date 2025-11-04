<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Send OTP for login/registration
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $request->phone;

        // Check if user exists
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found. Please register first.'
            ], 404);
        }

        try {
            // Generate OTP
            $otpCode = $this->generateOTP($user);
            $expiresAt = Carbon::now()->addMinutes(5);

            // Delete any existing OTPs for this phone
            Otp::where('phone', $phone)->delete();

            // Create new OTP
            Otp::create([
                'phone' => $phone,
                'otp' => $otpCode,
                'user_id' => $user->id,
                'expires_at' => $expiresAt,
            ]);

            // Send OTP based on user role
            if ($user->role === 'admin') {
                // For admin, return demo OTP (for testing)
                Log::info('Admin OTP generated (demo mode)', [
                    'phone' => $phone,
                    'otp' => $otpCode
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully',
                    'otp' => $otpCode // Only for admin demo
                ]);
            } else {
                // For client, send real SMS
                $smsSent = $this->sendSMS($phone, $otpCode);
                
                if ($smsSent) {
                    return response()->json([
                        'success' => true,
                        'message' => 'OTP sent to your phone successfully'
                    ]);
                } else {
                    // If SMS fails, still return success but log the issue
                    // This allows testing with the OTP that was generated
                    Log::warning('SMS sending failed but OTP was generated', [
                        'phone' => $phone,
                        'otp' => $otpCode
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'OTP generated (SMS may not have been sent)',
                        'otp' => $otpCode // Return OTP for testing when SMS fails
                    ]);
                }
            }

        } catch (\Exception $e) {
            Log::error('OTP sending failed', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    // Generate OTP - demo for admin, real for clients
    private function generateOTP($user)
    {
        if ($user->role === 'admin') {
            return '12345'; // Demo OTP for admin
        } else {
            // Generate random 5-digit OTP for clients
            return str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
        }
    }

    // Send SMS using the correct API
    private function sendSMS($phone, $otp)
    {
        try {
            // Format phone number properly
            $formattedPhone = preg_replace('/[^0-9]/', '', $phone);
            
            // Remove leading 0 and add 880
            if (substr($formattedPhone, 0, 1) === '0') {
                $formattedPhone = '880' . substr($formattedPhone, 1); // CORRECTED: 880 instead of 88
            }
            // If it doesn't start with 0, ensure it has 880
            else if (substr($formattedPhone, 0, 3) !== '880') {
                $formattedPhone = '880' . $formattedPhone;
            }

            // SMS API Configuration
            $apiKey = env('SMS_API_KEY');
            $senderId = env('SMS_SENDER_ID', 'SME CUBE');
            $message = "Your SMECube verification code is: {$otp}. Valid for 5 minutes.";

            // Correct API endpoint from documentation
            $url = "https://api.sms.net.bd/sendsms";

            // Send request with correct parameters
            $response = Http::timeout(30)->get($url, [
                'api_key' => $apiKey,
                'msg' => urlencode($message),
                'to' => $formattedPhone,
                'sender_id' => $senderId,
            ]);

            // Log the response for debugging
            Log::info('SMS API Response', [
                'phone' => $formattedPhone,
                'status' => $response->status(),
                'body' => $response->body(),
                'api_key' => substr($apiKey, 0, 8) . '...'
            ]);

            // Check if SMS was sent successfully
            if ($response->successful()) {
                $responseData = $response->json();
                
                // According to documentation, error: 0 means success
                if (isset($responseData['error']) && $responseData['error'] == 0) {
                    Log::info('SMS sent successfully', [
                        'request_id' => $responseData['data']['request_id'] ?? 'N/A'
                    ]);
                    return true;
                } else {
                    Log::error('SMS API returned error', [
                        'error_code' => $responseData['error'] ?? 'unknown',
                        'message' => $responseData['msg'] ?? 'No message'
                    ]);
                    return false;
                }
            }

            Log::error('SMS API HTTP error', [
                'status_code' => $response->status(),
                'response' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('SMS sending failed', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    // Verify OTP and login
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'otp' => 'required|string|size:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otp = Otp::where('phone', $request->phone)
                  ->where('otp', $request->otp)
                  ->where('used', false)
                  ->where('expires_at', '>', Carbon::now())
                  ->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        // Mark OTP as used
        $otp->update(['used' => true]);

        // Get user
        $user = User::find($otp->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Update phone verification if not already verified
        if (!$user->phone_verified_at) {
            $user->update(['phone_verified_at' => Carbon::now()]);
        }

        // Create token with appropriate abilities based on role
        $tokenAbilities = $user->role === 'admin' ? ['admin'] : ['client'];
        $token = $user->createToken('auth-token', $tokenAbilities)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'token' => $token
        ]);
    }

    // Register user with details (NO OTP - Direct registration)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:10|max:20|unique:users,phone',
            'email' => 'nullable|email|max:255|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create user directly with verified phone
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make(Str::random(16)), // Random password for phone users
                'role' => 'client',
                'phone_verified_at' => Carbon::now(), // Mark as verified immediately
            ]);

            // Create token immediately
            $token = $user->createToken('auth-token', ['client'])->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token
            ], 201);

        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get current user
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    // Optional: Check SMS balance (for debugging)
    private function checkSMSBalance()
    {
        try {
            $apiKey = env('SMS_API_KEY');
            $response = Http::get('https://api.sms.net.bd/user/balance/', [
                'api_key' => $apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('SMS Balance Check', $data);
                return $data;
            }
        } catch (\Exception $e) {
            Log::error('Balance check failed', ['error' => $e->getMessage()]);
        }
        return null;
    }
}