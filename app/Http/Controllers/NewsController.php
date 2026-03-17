<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the news page (index2)
     */
    public function index2(Request $request)
    {
        $locale = app()->getLocale();

        // جلب جميع الفئات
        $categories = NewsCategory::all();
        
         // جلب جميع الأخبار مع pagination للـ overview tab
        $allNews = News::with('category')->orderBy('date', 'desc')
            ->paginate(6, ['*'], 'page_overview');

        // جلب الأخبار لكل فئة مع pagination
        $newsByCategory = [];
        foreach ($categories as $category) {
            $newsByCategory[$category->slug] = News::where('category_id', $category->id)
                ->orderBy('date', 'desc')
                ->paginate(6, ['*'], 'page_' . $category->slug);
        }

        return view('website.news_updates.index2', compact('categories', 'newsByCategory','allNews', 'locale'));
    }

    /**
     * Display the news details page (details2)
     */
    public function details2($id)
    {
        $locale = app()->getLocale();

        // جلب الخبر مع الفئة
        $news = News::with('category')->findOrFail($id);

        // تحديد المحتوى حسب اللغة
        $content = $locale === 'ar' ? ($news->content_ar ?? '') : ($news->content_en ?? '');

        return view('website.news_updates.details2', compact('news', 'content', 'locale'));
    }
}

