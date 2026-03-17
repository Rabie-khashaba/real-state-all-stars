<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display the terms page (index2)
     */
    public function index2()
    {
        $term = Term::first(); // جلب أول سجل من جدول terms

        // تحديد اللغة الحالية
        $locale = app()->getLocale();

        $content = $term
            ? ($locale === 'ar' ? $term->content_ar : $term->content)
            : '';

        return view('website.terms.index2', compact('term', 'content', 'locale'));
    }
}

