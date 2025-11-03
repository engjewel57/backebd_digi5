<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PricingPlanController;
use App\Http\Controllers\Api\ExtraServiceController;
use App\Http\Controllers\Api\PlanComparisonController;
use App\Http\Controllers\Api\EcommerceController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\AdminAuthController;

// Test route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// ==================== AUTHENTICATION ROUTES ====================
// Public auth routes (with 'auth' prefix)
Route::prefix('auth')->group(function () {
    // User authentication
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // Google Auth
    Route::get('/google', [GoogleAuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
    Route::post('/google-login', [GoogleAuthController::class, 'handleGoogleLogin']);
    
    // Admin authentication
    Route::prefix('admin')->group(function () {
        Route::post('/send-otp', [AuthController::class, 'sendOtp']);
        Route::post('/verify-otp', [AdminAuthController::class, 'adminLogin']);
    });
    
    // Protected auth routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// ==================== PRICING ROUTES ====================
Route::prefix('pricing')->group(function () {
    Route::get('/plans', [PricingPlanController::class, 'index']);
    Route::post('/plans', [PricingPlanController::class, 'store']);
    Route::get('/plans/{id}', [PricingPlanController::class, 'show']);
    Route::put('/plans/{id}', [PricingPlanController::class, 'update']);
    Route::delete('/plans/{id}', [PricingPlanController::class, 'destroy']);
    
    Route::get('/services', [ExtraServiceController::class, 'index']);
    Route::post('/services', [ExtraServiceController::class, 'store']);
    Route::get('/services/{id}', [ExtraServiceController::class, 'show']);
    Route::put('/services/{id}', [ExtraServiceController::class, 'update']);
    Route::delete('/services/{id}', [ExtraServiceController::class, 'destroy']);
    
    Route::get('/comparisons', [PlanComparisonController::class, 'index']);
    Route::post('/comparisons', [PlanComparisonController::class, 'store']);
    Route::get('/comparisons/{id}', [PlanComparisonController::class, 'show']);
    Route::put('/comparisons/{id}', [PlanComparisonController::class, 'update']);
    Route::delete('/comparisons/{id}', [PlanComparisonController::class, 'destroy']);
});

// ==================== ECOMMERCE ROUTES ====================
Route::get('/ecommerce/page-data', [EcommerceController::class, 'getPageData']);

Route::prefix('admin/ecommerce')->group(function () {
    Route::get('/hero', [EcommerceController::class, 'getHero']);
    Route::put('/hero', [EcommerceController::class, 'updateHero']);
    
    Route::get('/features', [EcommerceController::class, 'getFeatures']);
    Route::post('/features', [EcommerceController::class, 'createFeature']);
    Route::put('/features/{id}', [EcommerceController::class, 'updateFeature']);
    Route::delete('/features/{id}', [EcommerceController::class, 'deleteFeature']);
    
    Route::get('/process-steps', [EcommerceController::class, 'getProcessSteps']);
    Route::post('/process-steps', [EcommerceController::class, 'createProcessStep']);
    Route::put('/process-steps/{id}', [EcommerceController::class, 'updateProcessStep']);
    Route::delete('/process-steps/{id}', [EcommerceController::class, 'deleteProcessStep']);
    
    Route::get('/demo-projects', [EcommerceController::class, 'getDemoProjects']);
    Route::post('/demo-projects', [EcommerceController::class, 'createDemoProject']);
    Route::put('/demo-projects/{id}', [EcommerceController::class, 'updateDemoProject']);
    Route::delete('/demo-projects/{id}', [EcommerceController::class, 'deleteDemoProject']);
    
    Route::get('/clients', [EcommerceController::class, 'getClients']);
    Route::post('/clients', [EcommerceController::class, 'createClient']);
    Route::put('/clients/{id}', [EcommerceController::class, 'updateClient']);
    Route::delete('/clients/{id}', [EcommerceController::class, 'deleteClient']);
});

// ==================== BLOG ROUTES ====================
Route::get('/blogs/page-data', [BlogController::class, 'getBlogPageData']);
Route::get('/blogs/{slug}', [BlogController::class, 'getBlogBySlug']);

Route::prefix('admin/blogs')->group(function () {
    Route::get('/posts', [BlogController::class, 'getAllPosts']);
    Route::post('/posts', [BlogController::class, 'createPost']);
    Route::put('/posts/{id}', [BlogController::class, 'updatePost']);
    Route::delete('/posts/{id}', [BlogController::class, 'deletePost']);
    
    Route::get('/categories', [BlogController::class, 'getCategories']);
    Route::post('/categories', [BlogController::class, 'createCategory']);
    Route::put('/categories/{id}', [BlogController::class, 'updateCategory']);
    Route::delete('/categories/{id}', [BlogController::class, 'deleteCategory']);
    
    Route::get('/reviews', [BlogController::class, 'getReviews']);
    Route::post('/reviews', [BlogController::class, 'createReview']);
    Route::put('/reviews/{id}', [BlogController::class, 'updateReview']);
    Route::delete('/reviews/{id}', [BlogController::class, 'deleteReview']);
});

// ==================== PROTECTED ROUTES ====================
Route::middleware('auth:sanctum')->group(function () {
    // Client routes
    Route::middleware('client')->prefix('client')->group(function () {
        Route::get('/dashboard', function () {
            return response()->json(['message' => 'Client dashboard']);
        });
    });

    // Admin routes
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return response()->json(['message' => 'Admin dashboard']);
        });
        Route::post('/create-admin', [AdminAuthController::class, 'createAdmin']);
    });
});