<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index($projectId)
    {
        $units = Unit::with(['developer', 'project', 'unitType'])->where('project_id', $projectId)->get();
        $data = $units->map(function($unit) {
            return [
                'id' => $unit->id,
                'developer_id' => $unit->developer_id ?? null,
                'project_id' => $unit->project_id ?? null,
                'unit_type_id' => $unit->unit_type_id ?? null,
                'name_en' => $unit->name_en ?? null,
                'name_ar' => $unit->name_ar ?? null,
                'bedrooms' => $unit->bedrooms ?? null,
                'bathrooms' => $unit->bathrooms ?? null,
                'area' => $unit->area ?? null,
                'price' => $unit->price ?? null,
                'about_en' => $unit->about_en ?? null,
                'about_ar' => $unit->about_ar ?? null,
                'master_plan' => $unit->master_plan ? config('app.image_domain') . '/storage/' . $unit->master_plan : null,
                'brochure' => $unit->brochure ? config('app.image_domain') . '/storage/' . $unit->brochure : null,
                'down_payment_percentage' => $unit->down_payment_percentage ?? null,
                'number_of_years' => $unit->number_of_years ?? null,
                'photos' => array_values(array_filter([
                    $unit->photo_1 ? config('app.image_domain') . '/storage/' . $unit->photo_1 : null,
                    $unit->photo_2 ? config('app.image_domain') . '/storage/' . $unit->photo_2 : null,
                    $unit->photo_3 ? config('app.image_domain') . '/storage/' . $unit->photo_3 : null,
            ])),
                'main_photo' => $unit->main_photo ? config('app.image_domain') . '/storage/' . $unit->main_photo : null,
                'is_visible' => $unit->is_visible ?? null,
                'developer' => $unit->developer ? [
                    'id' => $unit->developer->id,
                    'name_en' => $unit->developer->name_en,
                    'name_ar' => $unit->developer->name_ar,
                ] : null,
                'project' => $unit->project ? [
                    'id' => $unit->project->id,
                    'name_en' => $unit->project->name_en,
                    'name_ar' => $unit->project->name_ar,
                ] : null,
                'unit_type' => $unit->unitType ? [
                    'id' => $unit->unitType->id,
                    'type_en' => $unit->unitType->type_en,
                    'type_ar' => $unit->unitType->type_ar,
                ] : null,
                'created_at' => $unit->created_at,
                'updated_at' => $unit->updated_at,
            ];
        });

        return response()->json(['units' => $data]);
    }

    public function show($projectId, $unitId)
    {
        $unit = Unit::with(['developer', 'project', 'unitType'])->where('project_id', $projectId)->find($unitId);
        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $data = [
            'id' => $unit->id,
            'developer_id' => $unit->developer_id ?? null,
            'project_id' => $unit->project_id ?? null,
            'unit_type_id' => $unit->unit_type_id ?? null,
            'name_en' => $unit->name_en ?? null,
            'name_ar' => $unit->name_ar ?? null,
            'bedrooms' => $unit->bedrooms ?? null,
            'bathrooms' => $unit->bathrooms ?? null,
            'area' => $unit->area ?? null,
            'price' => $unit->price ?? null,
            'about_en' => $unit->about_en ?? null,
            'about_ar' => $unit->about_ar ?? null,
            'master_plan' => $unit->master_plan ? config('app.image_domain') . '/storage/' . $unit->master_plan : null,
            'brochure' => $unit->brochure ? config('app.image_domain') . '/storage/' . $unit->brochure : null,
            'down_payment_percentage' => $unit->down_payment_percentage ?? null,
            'number_of_years' => $unit->number_of_years ?? null,
            'photos' => array_values(array_filter([
                    $unit->photo_1 ? config('app.image_domain') . '/storage/' . $unit->photo_1 : null,
                    $unit->photo_2 ? config('app.image_domain') . '/storage/' . $unit->photo_2 : null,
                    $unit->photo_3 ? config('app.image_domain') . '/storage/' . $unit->photo_3 : null,
            ])),
            'main_photo' => $unit->main_photo ? config('app.image_domain') . '/storage/' . $unit->main_photo : null,
            'is_visible' => $unit->is_visible ?? null,
            'developer' => $unit->developer ? [
                'id' => $unit->developer->id,
                'name_en' => $unit->developer->name_en,
                'name_ar' => $unit->developer->name_ar,
            ] : null,
            'project' => $unit->project ? [
                'id' => $unit->project->id,
                'name_en' => $unit->project->name_en,
                'name_ar' => $unit->project->name_ar,
            ] : null,
            'unit_type' => $unit->unitType ? [
                'id' => $unit->unitType->id,
                'type_en' => $unit->unitType->type_en,
                'type_ar' => $unit->unitType->type_ar,
            ] : null,
            'created_at' => $unit->created_at,
            'updated_at' => $unit->updated_at,
        ];

        return response()->json(['unit' => $data]);
    }

    public function showUnit($id)
    {
        $unit = Unit::with(['developer', 'project', 'unitType'])->find($id);
        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $data = [
            'id' => $unit->id,
            'developer_id' => $unit->developer_id ?? null,
            'project_id' => $unit->project_id ?? null,
            'unit_type_id' => $unit->unit_type_id ?? null,
            'name_en' => $unit->name_en ?? null,
            'name_ar' => $unit->name_ar ?? null,
            'bedrooms' => $unit->bedrooms ?? null,
            'bathrooms' => $unit->bathrooms ?? null,
            'area' => $unit->area ?? null,
            'price' => $unit->price ?? null,
            'about_en' => $unit->about_en ?? null,
            'about_ar' => $unit->about_ar ?? null,
            'master_plan' => $unit->master_plan ? config('app.image_domain') . '/storage/' . $unit->master_plan : null,
            'brochure' => $unit->brochure ? config('app.image_domain') . '/storage/' . $unit->brochure : null,
            'down_payment_percentage' => $unit->down_payment_percentage ?? null,
            'number_of_years' => $unit->number_of_years ?? null,
            'photos' => array_values(array_filter([
                    $unit->photo_1 ? config('app.image_domain') . '/storage/' . $unit->photo_1 : null,
                    $unit->photo_2 ? config('app.image_domain') . '/storage/' . $unit->photo_2 : null,
                    $unit->photo_3 ? config('app.image_domain') . '/storage/' . $unit->photo_3 : null,
            ])),
            'main_photo' => $unit->main_photo ? config('app.image_domain') . '/storage/' . $unit->main_photo : null,
            'is_visible' => $unit->is_visible ?? null,
            'developer' => $unit->developer ? [
                'id' => $unit->developer->id,
                'name_en' => $unit->developer->name_en,
                'name_ar' => $unit->developer->name_ar,
            ] : null,
            'project' => $unit->project ? [
                'id' => $unit->project->id,
                'name_en' => $unit->project->name_en,
                'name_ar' => $unit->project->name_ar,
            ] : null,
            'unit_type' => $unit->unitType ? [
                'id' => $unit->unitType->id,
                'type_en' => $unit->unitType->type_en,
                'type_ar' => $unit->unitType->type_ar,
            ] : null,
            'created_at' => $unit->created_at,
            'updated_at' => $unit->updated_at,
        ];

        return response()->json(['unit' => $data]);
    }
}