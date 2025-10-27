<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanComparison;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PlanComparisonController extends Controller
{
    public function index(): JsonResponse
    {
        $comparisons = PlanComparison::orderBy('id')->get();
        
        return response()->json([
            'success' => true,
            'data' => $comparisons
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'feature_name' => 'required|string|max:100',
            'starter_value' => 'nullable|string|max:100',
            'professional_value' => 'nullable|string|max:100',
            'enterprise_value' => 'nullable|string|max:100'
        ]);

        $comparison = PlanComparison::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Plan comparison created successfully',
            'data' => $comparison
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $comparison = PlanComparison::find($id);

        if (!$comparison) {
            return response()->json([
                'success' => false,
                'message' => 'Plan comparison not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $comparison
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $comparison = PlanComparison::find($id);

        if (!$comparison) {
            return response()->json([
                'success' => false,
                'message' => 'Plan comparison not found'
            ], 404);
        }

        $validated = $request->validate([
            'feature_name' => 'sometimes|required|string|max:100',
            'starter_value' => 'nullable|string|max:100',
            'professional_value' => 'nullable|string|max:100',
            'enterprise_value' => 'nullable|string|max:100'
        ]);

        $comparison->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Plan comparison updated successfully',
            'data' => $comparison
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $comparison = PlanComparison::find($id);

        if (!$comparison) {
            return response()->json([
                'success' => false,
                'message' => 'Plan comparison not found'
            ], 404);
        }

        $comparison->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plan comparison deleted successfully'
        ]);
    }
}