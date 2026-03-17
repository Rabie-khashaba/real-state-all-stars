<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRequest;
class ContactRequestController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'inquiry' => 'required|string'
        ]);

        ContactRequest::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

}