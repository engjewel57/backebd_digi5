<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PricingPlanController;
use App\Http\Controllers\Api\ExtraServiceController;
use App\Http\Controllers\Api\PlanComparisonController;

// Test route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Pricing Plans Routes
Route::get('/pricing-plans', [PricingPlanController::class, 'index']);
Route::post('/pricing-plans', [PricingPlanController::class, 'store']);
Route::get('/pricing-plans/{id}', [PricingPlanController::class, 'show']);
Route::put('/pricing-plans/{id}', [PricingPlanController::class, 'update']);
Route::delete('/pricing-plans/{id}', [PricingPlanController::class, 'destroy']);

// Extra Services Routes
Route::get('/extra-services', [ExtraServiceController::class, 'index']);
Route::post('/extra-services', [ExtraServiceController::class, 'store']);
Route::get('/extra-services/{id}', [ExtraServiceController::class, 'show']);
Route::put('/extra-services/{id}', [ExtraServiceController::class, 'update']);
Route::delete('/extra-services/{id}', [ExtraServiceController::class, 'destroy']);

// Plan Comparisons Routes
Route::get('/plan-comparisons', [PlanComparisonController::class, 'index']);
Route::post('/plan-comparisons', [PlanComparisonController::class, 'store']);
Route::get('/plan-comparisons/{id}', [PlanComparisonController::class, 'show']);
Route::put('/plan-comparisons/{id}', [PlanComparisonController::class, 'update']);
Route::delete('/plan-comparisons/{id}', [PlanComparisonController::class, 'destroy']);