<?php

namespace App\Http\Controllers;

use App\Models\SponsorForm;
use Illuminate\Http\Request;

class SponsorFormController extends Controller
{
    public function store(Request $request)
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
            $path = $request->file('document')->store('sponsor_documents', 'public');
            $data['document_path'] = $path;
        }

        $data['agree'] = isset($data['agree']) && $data['agree'] ? true : false;

        if (!empty($data['type_of_partnership']) && is_array($data['type_of_partnership'])) {
            $data['type_of_partnership'] = array_values($data['type_of_partnership']);
        }

        SponsorForm::create([
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

        return back()->with('success', 'Sponsor submission received.');
    }
}
