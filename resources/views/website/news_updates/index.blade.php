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
            height: 430px;
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
            line-height: 32px;
            font-weight: 500;
            font-family: "NowM", sans-serif;
            color: #1D2939;
            margin: 0;
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
            <h2 class="head-title mb-4">{{__('new_update.stay_updated')}}</h2>

            <!-- التابات -->
            <!-- التابات -->
            <!-- التابات -->
            <ul class="nav nav-pills mb-5 ulTabs"
                id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="pill"
                            data-bs-target="#overview" type="button" role="tab">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="media-tab" data-bs-toggle="pill"
                            data-bs-target="#media" type="button" role="tab">Media Coverage</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="press-tab" data-bs-toggle="pill"
                            data-bs-target="#press" type="button" role="tab">Press Releases</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="upcoming-tab" data-bs-toggle="pill"
                            data-bs-target="#upcoming" type="button" role="tab">Upcoming Events</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="case-tab" data-bs-toggle="pill"
                            data-bs-target="#case" type="button" role="tab">Case Studies</button>
                </li>
            </ul>



            <!-- المحتوى -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <div class="row g-4 mb-5">

                        <div class="col-md-4 col-12">
                            <a class="link" href="{{url('/news/updates/details')}}">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame1.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Upcoming events</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">Building a Scalable Customer Onboarding Process</h5>
                                </div>
                            </div>
                        </a>
                        </div>


                        <div class="col-md-4 col-12">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame2.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Media Coverage</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">Why Predictive Analytics is a Game-Changer for SaaS </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame3.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Press Releases</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">How to Measure Customer Success KPIs Effectively</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame4.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Upcoming events</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">How AI is Revolutionizing Customer Success</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame5.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Media Coverage</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">5 Strategies to Reduce Customer Churn</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="news-card">
                                <!-- الصورة -->
                                <div class="image-wrapper">
                                    <img src="{{ asset('public/images/news/frame6.png') }}" alt="Image">
                                </div>

                                <!-- التفاصيل -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge-tag">Press Releases</span>
                                        <span class="date">Feb 28, 2025</span>
                                    </div>
                                    <h5 class="title mt-3">The Role of Sentiment Analysis in Customer </h5>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination custom-pagination gap-2">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">65</a></li>
                        </ul>
                    </div>

                </div>
                <!-- باقي التابات زي ما عندك -->
            </div>
        </div>
    </section>


@endsection
