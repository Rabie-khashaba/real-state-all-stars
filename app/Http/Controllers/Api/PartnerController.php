<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(): JsonResponse
    {
        $partners = Partner::orderByDesc('id')->get();

        $data = $partners->map(function ($partner) {
            return [
                'id' => $partner->id,
                'full_name' => $partner->full_name,
                'entity_country' => $partner->entity_country,
                'contact_person' => $partner->contact_person,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'entity_website' => $partner->entity_website,
                'type_of_partnership' => $partner->type_of_partnership,
                'other_sector' => $partner->other_sector,
                'interest_description' => $partner->interest_description,
                'document_path' => $partner->document_path,
                'document_url' => $partner->document_path ? asset('storage/' . $partner->document_path) : null,
                'agree' => $partner->agree,
                'created_at' => $partner->created_at,
                'updated_at' => $partner->updated_at,
            ];
        });

        return response()->json([
            'partners' => $data,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json([
                'message' => 'Partner not found',
            ], 404);
        }

        return response()->json([
            'partner' => [
                'id' => $partner->id,
                'full_name' => $partner->full_name,
                'entity_country' => $partner->entity_country,
                'contact_person' => $partner->contact_person,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'entity_website' => $partner->entity_website,
                'type_of_partnership' => $partner->type_of_partnership,
                'other_sector' => $partner->other_sector,
                'interest_description' => $partner->interest_description,
                'document_path' => $partner->document_path,
                'document_url' => $partner->document_path ? asset('storage/' . $partner->document_path) : null,
                'agree' => $partner->agree,
                'created_at' => $partner->created_at,
                'updated_at' => $partner->updated_at,
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'entity_country' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'entity_website' => 'nullable|url|max:255',
            'type_of_partnership' => 'nullable|array',
            'other_sector' => 'nullable|string|max:255',
            'interest_description' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'agree' => 'nullable|accepted',
        ]);

        if ($request->hasFile('document')) {
            $data['document_path'] = $request->file('document')->store('partners_documents', 'public');
        }

        $data['agree'] = !empty($data['agree']);

        if (!empty($data['type_of_partnership']) && is_array($data['type_of_partnership'])) {
            $data['type_of_partnership'] = array_values($data['type_of_partnership']);
        }

        $partner = Partner::create([
            'full_name' => $data['full_name'] ?? null,
            'entity_country' => $data['entity_country'] ?? null,
            'contact_person' => $data['contact_person'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'entity_website' => $data['entity_website'] ?? null,
            'type_of_partnership' => $data['type_of_partnership'] ?? null,
            'other_sector' => $data['other_sector'] ?? null,
            'interest_description' => $data['interest_description'] ?? null,
            'document_path' => $data['document_path'] ?? null,
            'agree' => $data['agree'] ?? false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Partner submission received.',
            'partner' => [
                'id' => $partner->id,
                'full_name' => $partner->full_name,
                'entity_country' => $partner->entity_country,
                'contact_person' => $partner->contact_person,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'entity_website' => $partner->entity_website,
                'type_of_partnership' => $partner->type_of_partnership,
                'other_sector' => $partner->other_sector,
                'interest_description' => $partner->interest_description,
                'document_path' => $partner->document_path,
                'document_url' => $partner->document_path ? asset('storage/' . $partner->document_path) : null,
                'agree' => $partner->agree,
                'created_at' => $partner->created_at,
            ],
        ]);
    }
}
