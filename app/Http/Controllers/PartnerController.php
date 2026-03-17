<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\ProjectDeveloper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display the partner landing page with partner lists.
     */
    public function index()
    {
        $strategicPartners = ProjectDeveloper::where('is_visible', 1)->whereJsonContains('roles', 'Strategic partner')->get();
        $developers = ProjectDeveloper::where('is_visible', 1)->whereJsonContains('roles', 'Developer')->get();
        $sponsors = ProjectDeveloper::where('is_visible', 1)->whereJsonContains('roles', 'Sponsor')->get();

        return view('website.partner.index', compact('strategicPartners', 'developers', 'sponsors'));
    }

    /**
     * Store a newly created partner submission.
     */
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
            $path = $request->file('document')->store('partners_documents', 'public');
            $data['document_path'] = $path;
        }

        // normalize agree
        $data['agree'] = isset($data['agree']) && $data['agree'] ? true : false;

        // ensure type_of_partnership stored as array
        if (!empty($data['type_of_partnership']) && is_array($data['type_of_partnership'])) {
            $data['type_of_partnership'] = array_values($data['type_of_partnership']);
        }

        Partner::create([
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

        return back()->with('success', 'Partner submission received.');
    }

}
