<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExtraService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExtraServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = ExtraService::where('is_active', true)
            ->orderBy('display_order')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'display_order' => 'integer'
        ]);

        $service = ExtraService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Extra service created successfully',
            'data' => $service
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $service = ExtraService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Extra service not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $service = ExtraService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Extra service not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'display_order' => 'integer'
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Extra service updated successfully',
            'data' => $service
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $service = ExtraService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Extra service not found'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Extra service deleted successfully'
        ]);
    }
}