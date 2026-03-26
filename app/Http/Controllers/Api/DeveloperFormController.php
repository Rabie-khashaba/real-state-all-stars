<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeveloperForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeveloperFormController extends Controller
{
    public function index(): JsonResponse
    {
        $developers = DeveloperForm::orderByDesc('id')->get();

        $data = $developers->map(function ($developer) {
            return [
                'id' => $developer->id,
                'full_name' => $developer->full_name,
                'entity_country' => $developer->entity_country,
                'contact_person' => $developer->contact_person,
                'phone' => $developer->phone,
                'email' => $developer->email,
                'entity_website' => $developer->entity_website,
                'type_of_partnership' => $developer->type_of_partnership,
                'other_sector' => $developer->other_sector,
                'interest_description' => $developer->interest_description,
                'document_path' => $developer->document_path,
                'document_url' => $developer->document_path ? asset('storage/' . $developer->document_path) : null,
                'agree' => $developer->agree,
                'created_at' => $developer->created_at,
                'updated_at' => $developer->updated_at,
            ];
        });

        return response()->json([
            'developers' => $data,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $developer = DeveloperForm::find($id);

        if (!$developer) {
            return response()->json([
                'message' => 'Developer not found',
            ], 404);
        }

        return response()->json([
            'developer' => [
                'id' => $developer->id,
                'full_name' => $developer->full_name,
                'entity_country' => $developer->entity_country,
                'contact_person' => $developer->contact_person,
                'phone' => $developer->phone,
                'email' => $developer->email,
                'entity_website' => $developer->entity_website,
                'type_of_partnership' => $developer->type_of_partnership,
                'other_sector' => $developer->other_sector,
                'interest_description' => $developer->interest_description,
                'document_path' => $developer->document_path,
                'document_url' => $developer->document_path ? asset('storage/' . $developer->document_path) : null,
                'agree' => $developer->agree,
                'created_at' => $developer->created_at,
                'updated_at' => $developer->updated_at,
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
            $data['document_path'] = $request->file('document')->store('developer_documents', 'public');
        }

        $data['agree'] = !empty($data['agree']);

        if (!empty($data['type_of_partnership']) && is_array($data['type_of_partnership'])) {
            $data['type_of_partnership'] = array_values($data['type_of_partnership']);
        }

        $developer = DeveloperForm::create([
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
            'message' => 'Developer submission received.',
            'developer' => [
                'id' => $developer->id,
                'full_name' => $developer->full_name,
                'entity_country' => $developer->entity_country,
                'contact_person' => $developer->contact_person,
                'phone' => $developer->phone,
                'email' => $developer->email,
                'entity_website' => $developer->entity_website,
                'type_of_partnership' => $developer->type_of_partnership,
                'other_sector' => $developer->other_sector,
                'interest_description' => $developer->interest_description,
                'document_path' => $developer->document_path,
                'document_url' => $developer->document_path ? asset('storage/' . $developer->document_path) : null,
                'agree' => $developer->agree,
                'created_at' => $developer->created_at,
            ],
        ]);
    }
}
