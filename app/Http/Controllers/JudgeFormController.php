<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\JudgeCon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JudgeFormController extends Controller
{



    public function index(){

        $judges = JudgeCon::all();
        return view ('website.judge.index' , compact('judges'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'professional_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'areas_of_expertise' => 'nullable|array',
            'areas_of_expertise.*' => 'nullable|string|max:255',
            'other_expertise' => 'nullable|string|max:255',
            'experience_description' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $areas = $data['areas_of_expertise'] ?? [];
        if (!empty($data['other_expertise'])) {
            $areas[] = $data['other_expertise'];
        }

        $judge = new Judge();
        $judge->full_name = $data['full_name'];
        $judge->professional_title = $data['professional_title'] ?? null;
        $judge->email = $data['email'] ?? null;
        $judge->phone = $data['phone'] ?? null;
        $judge->company = $data['company'] ?? null;
        $judge->areas_of_expertise = $areas ?? null;
        $judge->experience_description = $data['experience_description'] ?? null;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('judges_documents', 'public');
            $judge->document_path = $path;
        }

        $judge->save();

        // return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح — شكرًا لتقديمك.');
        return redirect()->back()->with('success', 'Your application has been submitted successfully.');

    }
}
