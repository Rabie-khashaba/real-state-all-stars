<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page (index2)
     */
    public function index2()
    {
        $locale = app()->getLocale();

        // جلب جميع الأسئلة والأجوبة من جدول faqs
        $faqs = Faq::all();

        // تجميع الأسئلة حسب الـ type
        $faqsByType = $faqs->groupBy('type');

        // جلب أنواع الـ tabs الفريدة
        $types = $faqs->pluck('type')->unique()->values();

        return view('website.faq.index2', compact('faqsByType', 'types', 'locale'));
    }
}

