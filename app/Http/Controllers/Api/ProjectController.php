<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['developer', 'country', 'city'])->get();
        $data = $projects->map(function($project) {
            return [
                'id' => $project->id,
                'developer_id' => $project->developer_id ?? null,
                'country_id' => $project->country_id ?? null,
                'city_id' => $project->city_id ?? null,
                'area_id' => $project->area_id ?? null,
                'name_en' => $project->name_en ?? null,
                'name_ar' => $project->name_ar ?? null,
                'short_description_en' => $project->short_description_en ?? null,
                'short_description_ar' => $project->short_description_ar ?? null,
                'overview_en' => $project->overview_en ?? null,
                'overview_ar' => $project->overview_ar ?? null,
                'interior_details_en' => $project->interior_details_en ?? null,
                'interior_details_ar' => $project->interior_details_ar ?? null,
                'master_plan' => $project->master_plan ? config('app.image_domain') . '/storage/' . $project->master_plan : null,
                'brochure' => $project->brochure ? config('app.image_domain') . '/storage/' . $project->brochure : null,
                'map_url' => $project->map_url ?? null,
                'main_photo' => $project->main_photo ? config('app.image_domain') . '/storage/' . $project->main_photo : null,
                'photos' => $project->photos ? array_map(function($photo) {
                    return config('app.image_domain') . '/storage/' . $photo;
                }, $project->photos) : [],
                'competition_status' => $project->competition_status ?? null,
                'is_visible' => $project->is_visible ?? null,
                'developer' => $project->developer ? [
                    'id' => $project->developer->id,
                    'name_en' => $project->developer->name_en,
                    'name_ar' => $project->developer->name_ar,
                ] : null,
                'country' => $project->country ? [
                    'id' => $project->country->id,
                    'name_en' => $project->country->name_en,
                    'name_ar' => $project->country->name_ar,
                ] : null,
                'city' => $project->city ? [
                    'id' => $project->city->id,
                    'name_en' => $project->city->name_en,
                    'name_ar' => $project->city->name_ar,
                ] : null,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ];
        });

        return response()->json(['projects' => $data]);
    }

    public function show($id)
    {
        $project = Project::with(['developer', 'country', 'city'])->find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $data = [
            'id' => $project->id,
            'developer_id' => $project->developer_id ?? null,
            'country_id' => $project->country_id ?? null,
            'city_id' => $project->city_id ?? null,
            'area_id' => $project->area_id ?? null,
            'name_en' => $project->name_en ?? null,
            'name_ar' => $project->name_ar ?? null,
            'short_description_en' => $project->short_description_en ?? null,
            'short_description_ar' => $project->short_description_ar ?? null,
            'overview_en' => $project->overview_en ?? null,
            'overview_ar' => $project->overview_ar ?? null,
            'interior_details_en' => $project->interior_details_en ?? null,
            'interior_details_ar' => $project->interior_details_ar ?? null,
            'master_plan' => $project->master_plan ? config('app.image_domain') . '/storage/' . $project->master_plan : null,
            'brochure' => $project->brochure ? config('app.image_domain') . '/storage/' . $project->brochure : null,
            'map_url' => $project->map_url ?? null,
            'main_photo' => $project->main_photo ? config('app.image_domain') . '/storage/' . $project->main_photo : null,
            'photos' => $project->photos ? array_map(function($photo) {
                return config('app.image_domain') . '/storage/' . $photo;
            }, $project->photos) : [],
            'competition_status' => $project->competition_status ?? null,
            'is_visible' => $project->is_visible ?? null,
            'developer' => $project->developer ? [
                'id' => $project->developer->id,
                'name_en' => $project->developer->name_en,
                'name_ar' => $project->developer->name_ar,
            ] : null,
            'country' => $project->country ? [
                'id' => $project->country->id,
                'name_en' => $project->country->name_en,
                'name_ar' => $project->country->name_ar,
            ] : null,
            'city' => $project->city ? [
                'id' => $project->city->id,
                'name_en' => $project->city->name_en,
                'name_ar' => $project->city->name_ar,
            ] : null,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
        ];

        return response()->json(['project' => $data]);
    }
}
