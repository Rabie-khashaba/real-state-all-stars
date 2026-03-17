@extends('website.layouts.master')

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

        .hero {
            position: relative;
            height: 505px; /* ⬅️ نص الشاشة */
            overflow: hidden;
            background: url("{{ asset('public/images/how_we/Who We Are.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
        }

        /* ✅ Overlay */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }


        /* ✅ Mobile only */
        @media (max-width: 576px) {
            .hero {
                height: 60vh; /* في الموبايل يكون أطول شوية */
            }

            .hero h1 {
                font-size: 1.6rem;
                line-height: 1.8rem;
            }


        }


        .main-heading {
            font-family: 'NowB', sans-serif;
            font-size: 35px;
        }

        .sub-heading {
            font-family: 'NowM', sans-serif;
            font-size: 20px;
        }

        .description-text {
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            line-height: 20px;
        }

        /* Mobile Only */
        /* xs - small phones */
        @media (max-width: 576px) {
            .main-heading {
                font-size: 20px;
            }

            .sub-heading {
                font-size: 14px;
            }

            .description-text {
                font-size: 12px;
                line-height: 18px;
                margin-bottom: 8px;
            }
        }

        /* sm - bigger phones / small tablets */
        @media (min-width: 577px) and (max-width: 768px) {
            .main-heading {
                font-size: 24px;
            }

            .sub-heading {
                font-size: 16px;
            }

            .description-text {
                font-size: 13px;
                line-height: 20px;
                margin-bottom: 10px;
            }

            .flags {
                margin-top: 0px !important;
                gap: 5px !important;
            }
        }

        /* md - tablets */
        @media (min-width: 430px) and (max-width: 992px) {
            .main-heading {
                font-size: 28px;
            }

            .sub-heading {
                font-size: 18px;
            }

            .description-text {
                font-size: 12px;
                line-height: 20px;
                margin-bottom: 12px;
            }

            .flags {
                margin-top: 0px !important;
                gap: 5px !important;
            }
        }

        @media (max-width: 667px) {
            .flag img {
                max-height: 28px !important; /* أصغر عشان يفضلوا في صف */
            }

            .flags {
                margin-top: 0px !important;
                gap: 5px !important;
            }
        }

        @media (max-width: 390px) {
            .main-heading {
                font-size: 16px !important; /* العنوان الرئيسي أصغر */
                line-height: 20px !important;
            }

            .sub-heading {
                font-size: 14px !important; /* العنوان الفرعي */
            }

            .description-text {
                font-size: 10px !important; /* الوصف أصغر */
                line-height: 15px !important; /* يقلل المسافة بين السطور */
                margin-bottom: 5px !important; /* يقلل المسافة تحت */
            }

            .flags {
                margin-top: 0px !important;
                gap: 5px !important;
            }
        }

        .flag {
            width: 60px;
        }


    </style>

    <style>
        .custom-box {
            background: #000;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            min-height: 113px;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            text-align: left;
            height: 113px;
        }

        .custom-box h3 {
            margin: 0;
            font-size: 20px;
        }

        .custom-box p {
            margin: 0;
            font-size: 13px;
        }

        .gold-box {
            background: linear-gradient(90deg, #C79720, #F8DA58);
            color: #000;
        }

        .tall-box {
            min-height: 240px; /* هنا نزود الطول */
        }

        .h2_box {
            color: #fff;
            font-family: 'NowB', sans-serif;
            font-size: 35px;
        }

        .p_box {
            color: #999999;
            font-size: 18px;
            font-family: 'NowM', sans-serif
            
        }

        .title {
            font-family: 'NowB', sans-serif;

            
        }

        @media (max-width: 576px) {
            .title {
                font-size: 15px; /* أصغر خط يناسب الموبايل */
            }
        }


        .btncolor{
            background: linear-gradient(90deg, #C79720, #F8DA58);
            color: #1a202c;
            border: none;
            font-family: 'NowM',sans-serif;
            transition: all 0.3s ease;
            font-size: 16px;

        }
        .btncolor:hover {
            background: linear-gradient(90deg, #F8DA58, #C79720); /* يعكس الألوان */
            transform: scale(1.05);
        }


        @media (max-width: 767px) {
            .custom-heading {
                font-size: 15px; /* أصغر في الموبايل */
            }
            .custom-paragraph {
                font-size: 9px;
                line-height: 20px;
            }
        }
        
        .small-title {
            font-size: 25px !important;
        }
        
        .ptext{
            font-size : 11px !important;
        }
        
        /* Mobile only */
@media (max-width: 576px) {

    /* الأرقام */
    .h2_box {
        font-size: 22px !important;   /* قلل الرقم */
        line-height: 1.2;
    }

    /* الوصف */
    .p_box {
        font-size: 12px !important;   /* قلل النص */
        line-height: 1.4;
    }

    /* البوكسات الطويلة */
    .tall-box .h2_box {
        font-size: 20px !important;
    }

    .tall-box .p_box {
        font-size: 11px !important;
    }
}

.custom-box {
    text-align: start; /* ذكي: شمال في EN / يمين في AR */
}


    </style>
@endsection

@section('content')
    {{--section 1--}}
    <section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->
            <div class="row d-flex flex-column justify-content-start text-white {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }} pt-5">
                <h1 class="col-12 col-md-12 mb-3 mt-5 pt-3 main-heading">
                    {{ app()->getLocale() === 'ar' ? $aboutUs->header_ar : $aboutUs->header_en }}
                </h1>
                <h3 class="col-12 col-md-12 mb-3 sub-heading">
                    {{ app()->getLocale() === 'ar' ? $aboutUs->subtitle_ar : $aboutUs->subtitle_en }}
                </h3>
                <p class="col-12 col-md-12 mb-4 description-text">
                    {{ app()->getLocale() === 'ar' ? $aboutUs->content_ar : $aboutUs->content_en }}
                </p>
            </div>

            <!-- Flags Row -->
            <div class="d-flex justify-content-center flex-wrap gap-5 mt-5 flags">
                <a href="#">
                    <div class="text-center flag">
                        <img src="{{asset('public/images/flags/flag5.png')}}" alt="USA" class="img-fluid "
                            style="max-height:40px;">

                    </div>
                </a>

                <a href="#">
                <div class="text-center flag">
                    <img src="{{asset('public/images/flags/flag4.png')}}" alt="UK" class="img-fluid "
                         style="max-height:40px;">
                </div>
                </a>

                <a href="#">
                <div class="text-center flag">
                    <img src="{{asset('public/images/flags/flag3.png')}}" alt="France" class="img-fluid "
                         style="max-height:40px;">
                </div>
                </a>

                <a href="#">
                <div class="text-center flag">
                    <img src="{{asset('public/images/flags/flag2.png')}}" alt="Germany" class="img-fluid "
                         style="max-height:40px;">
                </div>
                </a>

                <a href="#">
                <div class="text-center flag">
                    <img src="{{asset('public/images/flags/flag1.png')}}" alt="Saudi Arabia" class="img-fluid "
                         style="max-height:40px;">
                </div>
                </a>

            </div>
        </div>


    </section>
    {{--section 2 --}}
    <section class="my-5 py-2 bg-white">
        <div style="width:80%" class="container text-center">
            <!-- العنوان -->
            <h2 class="mb-3 title">{{__('who.real_estate_all_stars_title')}}</h2>

            <!-- GRID -->
            <div class="row g-3 justify-content-center">

                               <!-- الصف الأول -->
                <div class="col-md-6 col-12">
                    <div class="custom-box">
                        <h2 class="fw-bold h2_box">{{ __('who.first_competition_title') }}</h2>
                        <p class="p_box">{{ __('who.first_competition_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="custom-box">
                        <h3 class="fw-bold h2_box">{{ __('who.experience_years') }}</h3>
                        <p class="p_box">{{ __('who.experience_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="custom-box">
                        <h3 class="fw-bold h2_box">{{ __('who.mena_expansion_number') }}</h3>
                        <p class="p_box ptext  {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">{{ __('who.mena_expansion_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="custom-box">
                        <h2 class="fw-bold h2_box small-title">{{ __('who.contestants_number') }}</h2>
                        <p class="p_box">{{ __('who.contestants_desc') }}</p>
                    </div>
                </div>
                
                <!-- الصف الثاني -->
                <div class="col-md-3 col-6">
                    <div class="custom-box tall-box">
                        <h2 class="fw-bold h2_box">{{ __('who.developers_number') }}</h2>
                        <p class="p_box">{{ __('who.developers_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="custom-box tall-box">
                        <h2 class="fw-bold h2_box">{{ __('who.projects_number') }}</h2>
                        <p class="p_box">{{ __('who.projects_desc') }}</p>
                    </div>
                </div>
                
                <!-- عمودين متداخلين -->
                <div class="col-md-3 col-6 d-flex flex-column gap-3">
                    <div class="custom-box">
                        <h2 class="fw-bold h2_box">{{ __('who.social_videos_number') }}</h2>
                        <p class="p_box">{{ __('who.social_videos_desc') }}</p>
                    </div>
                    <div class="custom-box flex-grow-1">
                        <h2 class="fw-bold h2_box">{{ __('who.winners_number') }}</h2>
                        <p class="p_box">{{ __('who.winners_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 d-flex flex-column gap-3">
                    <div class="custom-box">
                        <h2 class="fw-bold h2_box">{{ __('who.judges_number') }}</h2>
                        <p class="p_box">{{ __('who.judges_desc') }}</p>
                    </div>
                    <div class="custom-box gold-box">
                        <h2 style="color: #000;" class="fw-bold h2_box">{{ __('who.prizes_amount') }}</h2>
                        <p style="color: #000000" class="p_box">{{ __('who.prizes_desc') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{--section 3 --}}
    <section class="py-2 mb-4 bg-white">
        <div class="container">
            <div class="row align-items-center">

                <!-- العمود الأول: النصوص -->
                <div class="col-md-6 mb-4 mb-md-0 order-2 order-md-1">
                    <h2 style="font-family: 'NowB', sans-serif; font-weight: 700; font-size: 35px;" class="custom-heading mb-3 mt-3">
                        {{ app()->getLocale() === 'ar' ? (optional($aboutIntro)->header_ar ?? '') : (optional($aboutIntro)->header_en ?? '') }}
                    </h2>
                    <p style="font-family: 'NowR', sans-serif; font-size: 16px; line-height: 25px;" class="custom-paragraph mb-4">
                      {!! nl2br(e(app()->getLocale() === 'ar' ? (optional($aboutIntro)->description_ar ?? '') : (optional($aboutIntro)->description_en ?? ''))) !!}

                    </p>
                    <!--<a href="{{url('contestant/registeration')}}" class="btn btn-light btn-lg btncolor">{{__('home.register_now')}}</a>-->
                    <a href="#" class="btn btn-light btn-lg btncolor">{{__('home.register_now')}}</a>
                </div>

                <!-- العمود الثاني: الصورة -->
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $aboutIntro->image }}"
                         alt="Real Estate"
                         class="img-fluid w-100 rounded">
                </div>

            </div>
        </div>
    </section>

@endsection
