@extends('website.layouts.master2')

@section('styles')
    <style>

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('public/font/Now-Bold.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowL';
            src: url("{{ asset('public/font/Now-Light.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowM';
            src: url("{{ asset('public/font/Now-Medium.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowTh';
            src: url("{{ asset('public/font/Now-Thin.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        .ulTabs {
            display: flex;
            flex-wrap: wrap;             /* ينزلوا تحت بعض في الشاشات الصغيرة */
            width: 61%;                 /* يملى عرض الصفحة */
            background: #EAECF0;         /* لون الخلفية */
            border-radius: 8px;
            padding: 0.5rem 0.5rem;
            justify-content: center;     /* يخليهم في النص */
            gap: 8px;                    /* مسافة بين العناصر */
            margin: 0;
        }

        .ulTabs .nav-item {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 0;
        }

        .ulTabs .nav-link {
            color: #333;
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 16px;
            font-family: "NowR", sans-serif;
            white-space: nowrap;         /* يمنع الكلمات من الانقسام لسطرين */
        }

        .ulTabs .nav-link.active {
            background-color: #000000;
            color: #fff !important;
        }

        /* تحسين للموبايل */
        @media (max-width: 768px) {
            .ulTabs {
                justify-content: center;   /* في الموبايل برضه في النص */
                padding: 0.5rem;
                width: 100%;
            }

            .ulTabs .nav-link {
                font-size: 14px;           /* خط أصغر شوية عشان ي fit */
                padding: 6px 12px;
            }
        }

        .news-card {
            background: #fff;
            border: 1px solid #E5E7EB;
            height: 440px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .news-card:hover {

            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .news-card .image-wrapper {
            width: 100%;
            height: 220px; /* ممكن تغيرها حسب التصميم */
            overflow: hidden;
        }

        .news-card .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .news-card .card-body {
            padding: 16px;
        }

        .news-card .badge-tag {
            background: #FFFFFF;
            color: #344054;
            font-size: 14px;
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 500;
            font-family: "NowR", sans-serif;
            border: 1px solid #D0D5DD;
        }

        .news-card .date {
            font-size: 16px;
            color: #6B7280;
            font-family: "NowR", sans-serif;
        }

        .news-card .title {
            font-size: 28px;
            line-height: 28px;
            font-weight: 500;
            font-family: "NowM", sans-serif;
            color: #1D2939;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .head-title{
            font-family: "NowR", sans-serif;
            font-size: 36px;
            font-weight: 400;
            color: #1D2939;
        }

        @media (max-width: 768px) {
            .head-title{
                font-size: 26px;
            }
        }

        .custom-pagination {
            flex-wrap: nowrap;          /* ✅ مايلفش */
            justify-content: center;
            overflow-x: auto;           /* ✅ يخليها تتحرك يمين/شمال في الموبايل */
            -webkit-overflow-scrolling: touch; /* smooth scroll في الموبايل */
            scrollbar-width: none;      /* يخفي الـ scrollbar في فايرفوكس */
        }
        .custom-pagination::-webkit-scrollbar {
            display: none;              /* يخفي الـ scrollbar في كروم وسفاري */
        }

        .custom-pagination .page-link {
            border-radius: 50% !important;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            padding: 0;
            margin: 0 5px;
            border: none;
            background-color: #e0e0e0;
            color: #000;
            font-weight: 500;
            flex: 0 0 auto; /* ✅ يخلي كل زر ياخد حجم ثابت */
        }

        .custom-pagination .page-item.active .page-link {
            background-color: #000;
            color: #fff;
        }

        .custom-pagination .page-link:hover {
            background-color: #555;
            color: #fff;
        }


        .link{
            text-decoration: none;
        }






    </style>
@endsection

@section('content')

    <section class="py-5 bg-white">
        <div class="container">
            <!-- العنوان -->
            <h2 class="head-title mb-4 ">
                {{ $locale === 'ar' ? 'تابع آخر الأخبار والفعاليات' : 'Stay Updated with Our Latest News and Events' }}
            </h2>

             <!-- التابات -->
            <ul class="nav nav-pills mb-5 ulTabs"
                id="pills-tab" role="tablist">
                <!-- Overview Tab -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            id="overview-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#overview"
                            type="button"
                            role="tab">
                        {{ $locale === 'ar' ? 'نظرة عامة' : 'Overview' }}
                    </button>
                </li>
                @if($categories && $categories->count() > 0)
                @foreach($categories as $index => $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="{{ $category->slug }}-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#{{ $category->slug }}"
                            type="button"
                            role="tab">
                        {{ $locale === 'ar' ? $category->name_ar : $category->name_en }}
                    </button>
                </li>
                @endforeach
                @endif
            </ul>



            <!-- المحتوى -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Overview Tab Content -->
                <div class="tab-pane fade show active"
                     id="overview"
                     role="tabpanel">
                    @if($allNews && $allNews->count() > 0)
                    <div class="row g-4 mb-5">
                        @foreach($allNews as $news)
                        <div class="col-md-4 col-12">
                            <a class="link" href="{{ route('news.details2', $news->id) }}">
                                <div class="news-card">
                                    <!-- الصورة -->
                                    <div class="image-wrapper">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $news->image_path }}"
                                             alt="{{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}">
                                    </div>

                                    <!-- التفاصيل -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge-tag">
                                                {{ $locale === 'ar' ? ($news->category->name_ar ?? '') : ($news->category->name_en ?? '') }}
                                            </span>
                                            <span class="date">
                                                {{ $news->date ? \Carbon\Carbon::parse($news->date)->format('M d, Y') : '' }}
                                            </span>
                                        </div>
                                        <h5 class="title mt-3">
                                            {{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination for Overview -->
                    @if($allNews->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination custom-pagination gap-2">
                            {{-- Previous Page Link --}}
                            @if ($allNews->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Page Links --}}
                            @php
                                $currentPage = $allNews->currentPage();
                                $lastPage = $allNews->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($startPage > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->url(1) }}">1</a>
                                </li>
                                @if($startPage > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            @for ($page = $startPage; $page <= $endPage; $page++)
                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $allNews->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($allNews->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $allNews->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    @else
                    <div class="alert alert-info">
                        <p>{{ $locale === 'ar' ? 'لا توجد أخبار متاحة.' : 'No news available.' }}</p>
                    </div>
                    @endif
                </div>

                @if($categories && $categories->count() > 0)
                @foreach($categories as $index => $category)
                <div class="tab-pane fade"
                     id="{{ $category->slug }}"
                     role="tabpanel">
                    @if(isset($newsByCategory[$category->slug]) && $newsByCategory[$category->slug]->count() > 0)
                    <div class="row g-4 mb-5">
                        @foreach($newsByCategory[$category->slug] as $news)
                        <div class="col-md-4 col-12">
                            <a class="link" href="{{ route('news.details2', $news->id) }}">
                                <div class="news-card">
                                    <!-- الصورة -->
                                    <div class="image-wrapper">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $news->image_path }}"
                                             alt="{{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}">
                                    </div>

                                    <!-- التفاصيل -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge-tag">
                                                {{ $locale === 'ar' ? $category->name_ar : $category->name_en }}
                                            </span>
                                            <span class="date">
                                                {{ $news->date ? \Carbon\Carbon::parse($news->date)->format('M d, Y') : '' }}
                                            </span>
                                        </div>
                                        <h5 class="title mt-3">
                                            {{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @php
                        $newsPaginator = $newsByCategory[$category->slug];
                    @endphp
                    @if($newsPaginator->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination custom-pagination gap-2">
                            {{-- Previous Page Link --}}
                            @if ($newsPaginator->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $newsPaginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Page Links --}}
                            @php
                                $currentPage = $newsPaginator->currentPage();
                                $lastPage = $newsPaginator->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($startPage > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $newsPaginator->url(1) }}">1</a>
                                </li>
                                @if($startPage > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            @for ($page = $startPage; $page <= $endPage; $page++)
                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $newsPaginator->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $newsPaginator->url($lastPage) }}">{{ $lastPage }}</a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($newsPaginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $newsPaginator->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    @else
                    <div class="alert alert-info">
                        <p>{{ $locale === 'ar' ? 'لا توجد أخبار متاحة في هذه الفئة.' : 'No news available in this category.' }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>


@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('#pills-tab .nav-link');

        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function () {
                // جيب البادجات جوه التاب اللي ظهر فقط
                const activeTabId = this.getAttribute('data-bs-target'); // ex: #overview

                // إذا كان التاب overview، لا تغير أي شيء (لأن overview يعرض كل الأخبار بفئاتها من قاعدة البيانات)
                if (activeTabId === '#overview') {
                    return; // توقف هنا ولا تعمل أي شيء
                }

                // جيب اسم الفئة من الزر (فقط للتبويبات الأخرى)
                const categoryName = this.textContent.trim();
                const activeTabContent = document.querySelector(activeTabId);

                if (activeTabContent) {
                    const badgesInActiveTab = activeTabContent.querySelectorAll('.badge-tag');

                    // تغيير badges فقط للتبويبات الأخرى (ليس overview)
                    badgesInActiveTab.forEach(badge => {
                        badge.textContent = categoryName;
                    });
                }
            });
        });
    });
</script>


