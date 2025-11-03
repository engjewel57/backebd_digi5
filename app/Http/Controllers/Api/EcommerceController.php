<?php
// app/Http/Controllers/EcommerceController.php

namespace App\Http\Controllers\Api;

use App\Models\EcommerceHeroSection;
use App\Models\EcommerceFeature;
use App\Models\EcommerceProcessStep;
use App\Models\EcommerceDemoProject;
use App\Models\EcommerceClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EcommerceController extends Controller
{
    // Get all data for frontend
    public function getPageData()
    {
        $hero = EcommerceHeroSection::where('is_active', true)->first();
        $features = EcommerceFeature::where('is_active', true)->orderBy('display_order')->get();
        $processSteps = EcommerceProcessStep::where('is_active', true)->orderBy('display_order')->get();
        $demoProjects = EcommerceDemoProject::where('is_active', true)->orderBy('display_order')->get();
        $clients = EcommerceClient::where('is_active', true)->orderBy('display_order')->get();

        return response()->json([
            'hero' => $hero,
            'features' => $features,
            'processSteps' => $processSteps,
            'demoProjects' => $demoProjects,
            'clients' => $clients,
        ]);
    }

    // Hero Section CRUD
    public function getHero()
    {
        $hero = EcommerceHeroSection::first();
        return response()->json($hero);
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'cta1_text' => 'required|string|max:255',
            'cta2_text' => 'required|string|max:255',
            'stats' => 'required|array',
        ]);

        $hero = EcommerceHeroSection::firstOrNew([]);
        $hero->fill($request->all());
        $hero->save();

        return response()->json($hero);
    }

    // Features CRUD
    public function getFeatures()
    {
        $features = EcommerceFeature::orderBy('display_order')->get();
        return response()->json($features);
    }

    public function createFeature(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'gradient' => 'required|string|max:100',
            'icon_bg' => 'required|string|max:100',
        ]);

        $feature = EcommerceFeature::create($request->all());
        return response()->json($feature, 201);
    }

    public function updateFeature(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'icon' => 'sometimes|string|max:50',
            'gradient' => 'sometimes|string|max:100',
            'icon_bg' => 'sometimes|string|max:100',
        ]);

        $feature = EcommerceFeature::findOrFail($id);
        $feature->update($request->all());

        return response()->json($feature);
    }

    public function deleteFeature($id)
    {
        $feature = EcommerceFeature::findOrFail($id);
        $feature->delete();

        return response()->json(null, 204);
    }

    // Process Steps CRUD
    public function getProcessSteps()
    {
        $steps = EcommerceProcessStep::orderBy('display_order')->get();
        return response()->json($steps);
    }

    public function createProcessStep(Request $request)
    {
        $request->validate([
            'step_number' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'gradient' => 'required|string|max:100',
            'icon_bg' => 'required|string|max:100',
        ]);

        $step = EcommerceProcessStep::create($request->all());
        return response()->json($step, 201);
    }

    public function updateProcessStep(Request $request, $id)
    {
        $request->validate([
            'step_number' => 'sometimes|string|max:10',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'gradient' => 'sometimes|string|max:100',
            'icon_bg' => 'sometimes|string|max:100',
        ]);

        $step = EcommerceProcessStep::findOrFail($id);
        $step->update($request->all());

        return response()->json($step);
    }

    public function deleteProcessStep($id)
    {
        $step = EcommerceProcessStep::findOrFail($id);
        $step->delete();

        return response()->json(null, 204);
    }

    // Demo Projects CRUD
    public function getDemoProjects()
    {
        $projects = EcommerceDemoProject::orderBy('display_order')->get();
        return response()->json($projects);
    }

    public function createDemoProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url|max:500',
            'gradient' => 'required|string|max:100',
        ]);

        $project = EcommerceDemoProject::create($request->all());
        return response()->json($project, 201);
    }

    public function updateDemoProject(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image_url' => 'sometimes|url|max:500',
            'gradient' => 'sometimes|string|max:100',
        ]);

        $project = EcommerceDemoProject::findOrFail($id);
        $project->update($request->all());

        return response()->json($project);
    }

    public function deleteDemoProject($id)
    {
        $project = EcommerceDemoProject::findOrFail($id);
        $project->delete();

        return response()->json(null, 204);
    }

    // Clients CRUD
    public function getClients()
    {
        $clients = EcommerceClient::orderBy('display_order')->get();
        return response()->json($clients);
    }

    public function createClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
        ]);

        $client = EcommerceClient::create($request->all());
        return response()->json($client, 201);
    }

    public function updateClient(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'domain' => 'sometimes|string|max:255',
        ]);

        $client = EcommerceClient::findOrFail($id);
        $client->update($request->all());

        return response()->json($client);
    }

    public function deleteClient($id)
    {
        $client = EcommerceClient::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}