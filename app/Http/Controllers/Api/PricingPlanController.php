<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PricingPlanController extends Controller
{
    public function index(): JsonResponse
    {
        $plans = PricingPlan::where('is_active', true)
            ->orderBy('display_order')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $plans
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:monthly,annual',
            'subtitle' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_unit' => 'nullable|string|max:20',
            'price_period' => 'nullable|string|max:20',
            'discount_info' => 'nullable|string|max:255',
            'features' => 'required|array',
            'features.*' => 'string',
            'is_popular' => 'boolean',
            'display_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $plan = PricingPlan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pricing plan created successfully',
            'data' => $plan
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $plan = PricingPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Pricing plan not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $plan
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $plan = PricingPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Pricing plan not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'type' => 'sometimes|required|in:monthly,annual',
            'subtitle' => 'nullable|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'price_unit' => 'nullable|string|max:20',
            'price_period' => 'nullable|string|max:20',
            'discount_info' => 'nullable|string|max:255',
            'features' => 'sometimes|required|array',
            'features.*' => 'string',
            'is_popular' => 'boolean',
            'display_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $plan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pricing plan updated successfully',
            'data' => $plan
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $plan = PricingPlan::find($id);

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Pricing plan not found'
            ], 404);
        }

        $plan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pricing plan deleted successfully'
        ]);
    }
}