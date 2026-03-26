<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SponsorForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SponsorFormController extends Controller
{
    public function index(): JsonResponse
    {
        $sponsors = SponsorForm::orderByDesc('id')->get();

        $data = $sponsors->map(function ($sponsor) {
            return [
                'id' => $sponsor->id,
                'full_name' => $sponsor->full_name,
                'entity_country' => $sponsor->entity_country,
                'contact_person' => $sponsor->contact_person,
                'phone' => $sponsor->phone,
                'email' => $sponsor->email,
                'entity_website' => $sponsor->entity_website,
                'type_of_partnership' => $sponsor->type_of_partnership,
                'other_sector' => $sponsor->other_sector,
                'interest_description' => $sponsor->interest_description,
                'document_path' => $sponsor->document_path,
                'document_url' => $sponsor->document_path ? asset('storage/' . $sponsor->document_path) : null,
                'agree' => $sponsor->agree,
                'created_at' => $sponsor->created_at,
                'updated_at' => $sponsor->updated_at,
            ];
        });

        return response()->json([
            'sponsors' => $data,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $sponsor = SponsorForm::find($id);

        if (!$sponsor) {
            return response()->json([
                'message' => 'Sponsor not found',
            ], 404);
        }

        return response()->json([
            'sponsor' => [
                'id' => $sponsor->id,
                'full_name' => $sponsor->full_name,
                'entity_country' => $sponsor->entity_country,
                'contact_person' => $sponsor->contact_person,
                'phone' => $sponsor->phone,
                'email' => $sponsor->email,
                'entity_website' => $sponsor->entity_website,
                'type_of_partnership' => $sponsor->type_of_partnership,
                'other_sector' => $sponsor->other_sector,
                'interest_description' => $sponsor->interest_description,
                'document_path' => $sponsor->document_path,
                'document_url' => $sponsor->document_path ? asset('storage/' . $sponsor->document_path) : null,
                'agree' => $sponsor->agree,
                'created_at' => $sponsor->created_at,
                'updated_at' => $sponsor->updated_at,
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
            $data['document_path'] = $request->file('document')->store('sponsor_documents', 'public');
        }

        $data['agree'] = !empty($data['agree']);

        if (!empty($data['type_of_partnership']) && is_array($data['type_of_partnership'])) {
            $data['type_of_partnership'] = array_values($data['type_of_partnership']);
        }

        $sponsor = SponsorForm::create([
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
            'message' => 'Sponsor submission received.',
            'sponsor' => [
                'id' => $sponsor->id,
                'full_name' => $sponsor->full_name,
                'entity_country' => $sponsor->entity_country,
                'contact_person' => $sponsor->contact_person,
                'phone' => $sponsor->phone,
                'email' => $sponsor->email,
                'entity_website' => $sponsor->entity_website,
                'type_of_partnership' => $sponsor->type_of_partnership,
                'other_sector' => $sponsor->other_sector,
                'interest_description' => $sponsor->interest_description,
                'document_path' => $sponsor->document_path,
                'document_url' => $sponsor->document_path ? asset('storage/' . $sponsor->document_path) : null,
                'agree' => $sponsor->agree,
                'created_at' => $sponsor->created_at,
            ],
        ]);
    }
}
