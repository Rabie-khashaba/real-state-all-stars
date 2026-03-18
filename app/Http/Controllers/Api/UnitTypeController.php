<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    public function index()
    {
        $unitTypes = UnitType::all();
        $data = $unitTypes->map(function($unitType) {
            return [
                'id' => $unitType->id,
                'type_en' => $unitType->type_en ?? null,
                'type_ar' => $unitType->type_ar ?? null,
                'created_at' => $unitType->created_at,
                'updated_at' => $unitType->updated_at,
            ];
        });

        return response()->json(['unit_types' => $data]);
    }

    public function show($id)
    {
        $unitType = UnitType::find($id);
        if (!$unitType) {
            return response()->json(['message' => 'Unit type not found'], 404);
        }

        $data = [
            'id' => $unitType->id,
            'type_en' => $unitType->type_en ?? null,
            'type_ar' => $unitType->type_ar ?? null,
            'created_at' => $unitType->created_at,
            'updated_at' => $unitType->updated_at,
        ];

        return response()->json(['unit_type' => $data]);
    }
}
