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
            height: 100vh;
            overflow: hidden;
        }
        /* ✅ Video full cover */
        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }
        /* ✅ Overlay */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.35);
            z-index: -1;
        }

        .hero-logo {
            max-height: 60px;
        }

        /* ✅ Mobile only */
        @media (max-width: 576px) {
            /* النص والزرار */
                .hero {
                    height: 75vh !important; /* بدل 70vh بالارتفاع المناسب */
                }
            .hero-content {
                align-items: center !important;
                text-align: center !important;
            }



            .hero h1 {
                font-size: 1.6rem;
                line-height: 1.8rem;
            }

            .hero .textB{
                font-size : 35px;
            }

            /* اللوجوهات */
            .logos-wrapper {
                justify-content: center !important;
                gap: 20px;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .hero-logo {
                max-height: 40px;
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
        .subtitle-text{
            width: 788px;
            font-family: 'NowB',sans-serif;
            font-size: 29px;
        }

        .main-title {
            font-family: 'NowB', sans-serif;
            font-weight: 700;
            font-size: 35px;
            line-height: 120%;
            color: #000;
        }

        .title-underline {
            width: 208px;
            height: 3px;
            background: #000;
            border: none;
            margin: 10px 0 20px 0;
        }

        .sub-title {
            font-family: 'NowB', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: #000;
        }

        .description {
            font-family: 'NowR',sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 25px;
            color: #170101;
            height: auto; /* ✅ ما يبقاش ثابت */
        }

        .about-img {
            object-fit: cover;
            max-width: 100%;
            height: auto;
            width: 100%;
        }

        /* ✅ Responsive */
        @media (max-width: 768px) {
            .subtitle-text {
                display: block;
                width: 100%;
                max-width: 100%;
                font-size: 18px;
                line-height: 1.5;
            }

            .about-section {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            .about-section .row {
                row-gap: 1.5rem;
            }

            .about-section .col-md-6 {
                text-align: center;
            }

            .main-title {
                font-size: 20px; /* أصغر في الموبايل */
                line-height: 1.4;
            }
            .sub-title {
                font-size: 16px;
                line-height: 1.5;
            }
            .description {
                font-size: 14px;
                line-height: 22px;
                text-align: center;
            }
            .title-underline {
                width: 120px;
                margin: 10px auto 20px;
            }
            .about-img {
                width: 100%;
                max-width: 280px;
                max-height: 360px;
                margin: 0 auto;
                display: block;
                object-fit: cover;
            }
        }

        .section-bg {
            width: 100%;
            height: 579px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .h3_n{
            font-family: 'NowR',sans-serif;
        }

        .p_text{
            font-family: 'NowR',sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #EDBF2E;
        }

        /*.carousel-control-prev-icon,*/
        /*.carousel-control-next-icon {*/
        /*    filter: invert(100%) grayscale(100%); !* يخلي الأيقونة سوداء *!*/
        /*}*/

        .owl-carousel .item img,
        .judges-visible-carousel > div > img {

            width: 240px;
            height: auto;
            border-radius: 10px;
        }

        .judges-visible-carousel {
            overflow: hidden;
            padding: 8px 0;
        }

        .judges-visible-track {
            display: flex;
            gap: 10px;
            width: max-content;
            animation: judgesAutoMove 18s linear infinite;
        }

        .judges-visible-carousel:hover .judges-visible-track {
            animation-play-state: paused;
        }

        .judges-visible-track > div {
            display: inline-block;
            vertical-align: top;
            flex: 0 0 auto;
        }

        @keyframes judgesAutoMove {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        /* الأسهم باللون الأسود */
        .owl-nav .prev,
        .owl-nav .next {
            color: black !important;
            font-size: 32px !important;
            font-weight: bold;
            margin: 0 15px;
            cursor: pointer;
        }

        .owl-nav .prev:hover,
        .owl-nav .next:hover {
            color: #333 !important;
        }

        /* توسيط الأسهم */
        .owl-nav {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 40%;
            left: 0;
            right: 0;
            padding: 0 10px;
        }

        @media (max-width: 767px) {
            .responsive-title {
                max-width: 90%;
                margin: 0 auto;
                font-size: 15px;
                display: block;
                line-height: 1.4;
                word-break: break-word; /* يخلي الكلام ينزل تحت تلقائي */
            }
        }

        .prizes-section {
            background-image: url("{{asset('public/images/home/deadline-bg.png')}}");
            background-size: cover;
            background-position: center;
            height: 298px;
            padding-top: 60px;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        .prize_n{
            font-family: 'NowM',sans-serif;
            font-size: 16px;
            color: #F8DA58;
        }

        .title_p {
            font-family: 'NowM', sans-serif;
        }

        .title_p {
            font-family: 'NowB', sans-serif;
            font-size: 14px; /* Mobile افتراضياً */
            line-height: 20px;
        }

        @media (min-width: 768px) {
            .title_p {
                font-size: 24px; /* Desktop */
                line-height: 28px;
            }
        }

        .textB{
            font-family: 'NowB', sans-serif;
            font-size: 50px;

        }


        .text_vote{
            font-size: 28px;
        }

    </style>
@endsection


@section('content')
{{-- Hero Section --}}
<section class="hero">
        <!-- Background Video -->
       <video autoplay muted loop playsinline>
    <source
        src="{{ $header?->image
            ? rtrim(config('app.image_domain'), '/') . '/storage/' . $header->image
            : asset('/public/images/videos/Web-Archived.mp4') }}"
        type="video/mp4"
    >
    Your browser does not support the video tag.
</video>

        <!-- ✅ Content -->
        <div class="d-flex flex-column justify-content-center align-items-start text-white h-100 container hero-content">
            <h1 class="fw-bold mb-3">
                <span class="text display-4 d-block textB">
                    {{ app()->getLocale() === 'ar' ? optional($header)->text_ar : optional($header)->text_en }}
                </span>
                <span class="subtitle-text">
                    {{ app()->getLocale() === 'ar' ? optional($header)->description_ar : optional($header)->description_en }}
                </span>
            </h1>
            <a href="{{url('/how_it_work')}}" class="btn btn-light btn-lg mt-3 btncolor">{{__('home.apply_now')}}</a>
            <!--<a href="#" class="btn btn-light btn-lg mt-3 btncolor">{{__('home.apply_now')}}</a>-->
        </div>

        <!-- ✅ Bottom Logos -->
        <div class="position-absolute bottom-0 w-100 d-flex justify-content-between px-4 pb-4 logos-wrapper">
            <img src="{{ asset('public/images/logo/Group 1597883384.png') }}" alt="Left Logo" class="hero-logo">
            <!--<img src="{{ asset('public/images/logo/logo_right.png') }}" alt="Right Logo" class="hero-logo">-->
        </div>
    </section>

{{-- section 2--}}
<section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Box 1 (النصوص) -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="main-title mb-2">{{ app()->getLocale() === 'ar' ? optional($ourProgram)->welcome_ar : optional($ourProgram)->welcome_en }}</h2>

                    <!-- خط تحت العنوان -->
                    <hr class="title-underline">

                    <!-- العنوان الفرعي -->
                    <h4 class="sub-title mb-3">
                        {{ app()->getLocale() === 'ar' ? optional($ourProgram)->title_ar : optional($ourProgram)->title_en }}
                    </h4>

                    <!-- النص -->
                    <p class="description">
                        {!! nl2br(e(app()->getLocale() === 'ar' ? optional($ourProgram)->description_ar : optional($ourProgram)->description_en)) !!}
                    </p>
                </div>

                <!-- Box 2 (الصورة) -->
                <div class="col-md-6 mb-4 mb-md-0 text-center">
                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $ourProgram->image }}" alt="About Image" class="img-fluid rounded shadow about-img">
                </div>
            </div>
        </div>
    </section>

{{-- section 3 --}}
<section class="container-fluid  p-0 overflow-hidden">
        <div class="row mb-5 g-3"> <!-- g-3 لعمل gap بين الأعمدة -->
            <!-- Section 1 -->
            <div class="col-12 col-md-6  ">
                <div class="section-bg d-flex flex-column justify-content-center align-items-center text-center pt-5 mt-2" style="background-image: url('{{ asset('public/images/home/hero.png') }}');">
                    <h2 style="width:388px; font-family: 'NowM', sans-serif;" class="text-white mb-2">{{ app()->getLocale() === 'ar' ? optional($countdown)->title_ar : optional($countdown)->title_en }}</h2>
                    <p style="width:340px; font-family: 'NowR', sans-serif;font-size: 13px; line-height: 20px" class="text-white mb-3" >{{ app()->getLocale() === 'ar' ? optional($countdown)->description_ar : optional($countdown)->description_en }}</p>
                    <div style="width:301px" class="d-flex justify-content-center gap-4 mb-3">
                       {{-- <div>
                            <h3 class="text-white mb-0 h3_n">30</h3>
                            <p class="p_text  mb-0">{{__('home.Days')}}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">12</h3>
                            <p class="p_text mb-0">{{__('home.Hours')}}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">45</h3>
                            <p class=" p_text mb-0">{{__('home.Minutes')}}</p>
                        </div> --}}

                        <div>
                            <h3 id="countdown-days" class="text-white mb-0 h3_n">30</h3>
                            <p class="p_text  mb-0">{{__('home.Days')}}</p>
                        </div>
                        <div>
                            <h3 id="countdown-hours" class="text-white mb-0 h3_n">12</h3>
                            <p class="p_text mb-0">{{__('home.Hours')}}</p>
                        </div>
                        <div>
                            <h3 id="countdown-minutes" class="text-white mb-0 h3_n">45</h3>
                            <p class=" p_text mb-0">{{__('home.Minutes')}}</p>
                        </div>

                    </div>
                    <a href="{{url('contestant/registeration')}}" style="width: 160px;" class="btn btn-light btncolor">{{__('home.register_now')}}</a>
                    <!--<a href="#" style="width: 160px;" class="btn btn-light btncolor">{{__('home.register_now')}}</a>-->
                </div>
            </div>

            <!-- Section 2 -->
            <div class="col-12 col-md-6  ">
                <div class="section-bg d-flex flex-column justify-content-center align-items-center text-center pt-5 mt-2" style="background-image: url('{{asset('public/images/home/vote-bg.png')}}'); height:579px;">
                    <h2 style="width:388px; font-family: 'NowM', sans-serif;" class="text_vote text-white mb-2">{{ app()->getLocale() === 'ar' ? optional($vote)->header_ar : optional($vote)->header_en }}</h2>
                    <p style="width:340px; font-family: 'NowR', sans-serif;font-size: 13px; line-height: 20px;" class=" text-white mb-3">{{ app()->getLocale() === 'ar' ? optional($vote)->description_ar : optional($vote)->description_en }}</p>
                    <div class="d-flex justify-content-center gap-4 mb-3">
                      {{--  <div>
                            <h3 class="text-white mb-0 h3_n">6523</h3>
                            <p class="p_text mb-0">{{__('home.Contestants')}}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">52416</h3>
                            <p class="p_text mb-0">{{__('home.Votes')}}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">45</h3>
                            <p class="p_text mb-0">{{__('home.Projects')}}</p>
                        </div> --}}


                        @php
use Carbon\Carbon;

// تاريخ البداية (غيّره حسب مشروعك)
$startDate = Carbon::create(2026, 1,20);

// تاريخ اليوم
$today = Carbon::today();

// عدد الأيام من البداية لليوم (شامل اليوم)
$daysCount = $startDate->diffInDays($today) + 1;

$totalIncrease = 0;

// نحسب زيادة كل يوم
for ($i = 0; $i < $daysCount; $i++) {

    // seed ثابت لكل يوم
    $daySeed = $startDate->copy()->addDays($i)->format('Ymd');
    mt_srand((int) $daySeed);

    // رقم عشوائي ثابت لليوم (20 - 30)
    $dailyIncrease = mt_rand(20, 30);

    $totalIncrease += $dailyIncrease;
}

// الرقم النهائي
$finalContestantsNumber =
    ($contestantsCount ?? 0) + 1000 + $totalIncrease;
@endphp



                        <div>
                            <h3 class="text-white mb-0 h3_n">{{ 1735 }}</h3>
                            <p class="p_text mb-0">{{ __('home.Contestants') }}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">{{ number_format($votesCount ?? 0) }}</h3>
                            <p class="p_text mb-0">{{ __('home.Votes') }}</p>
                        </div>
                        <div>
                            <h3 class="text-white mb-0 h3_n">{{ number_format($projectsCount ?? 0) }}</h3>
                            <p class="p_text mb-0">{{ __('home.Projects') }}</p>
                        </div>
                    </div>
                    <a href="{{'vote'}}" style="width: 160px;" class="btn btn-light btncolor">{{__('home.vote_now')}}</a>
                </div>
            </div>
        </div>
    </section>

{{-- section 4 --}}
<section class="container-fluid p-4">

    <div  class="row mb-4">
        <div class="col-12 col-md-12 text-center">
            <h2 style="font-family: 'NowB', sans-serif; font-weight: 700; font-size: 20px;" class="fw-bold text-uppercase responsive-title">
                {{ app()->getLocale() === 'ar' ? optional($judgeSettings)->title_ar : optional($judgeSettings)->title_en }}
            </h2>
        </div>
    </div>

    <div class="judges-visible-carousel">
        <div class="judges-visible-track">
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 2"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 3"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 4"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 5"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 6"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 7"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 8"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 9"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 10"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 2"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 3"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 4"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 5"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 6"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 7"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 8"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 9"></div>
            <div><img src="{{asset('public/images/home/person.png')}}" class="img-fluid" alt="Team 10"></div>
        </div>
    </div>
</section>

{{-- section 5 --}}
<section class="text-center prizes-section">
        <div class="container">
            <!-- Head -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 style="font-family: 'NowM', sans-serif;line-height: 35px; font-size: 25px;" class="text-uppercase text-white">
                        {{ app()->getLocale() === 'ar' ? optional($prize)->title_ar : optional($prize)->title_en }}
                    </h2>
                </div>
            </div>

            <!-- Icons + Numbers -->
            <div class="row g-4 justify-content-center">
                <!-- Prize 1 -->
                <div class="col-2 col-md-2">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset('public/images/home/icon1.png')}}" class="img-fluid mb-2" alt="Prize 1">
                        <h3 class="prize_n">{{ optional($prize)->prize1_amount }}</h3>
                    </div>
                </div>

                <!-- Prize 2 -->
                <div class="col-2 col-md-2">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset('public/images/home/icon2.png')}}" class="img-fluid mb-2" style="max-height:80px;" alt="Prize 2">
                        <h3 class="prize_n">{{ optional($prize)->prize2_amount }}</h3>
                    </div>
                </div>

                <!-- Prize 3 -->
                <div class="col-2 col-md-2">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset('public/images/home/icon3.png')}}" class="img-fluid mb-2" style="max-height:80px;" alt="Prize 3">
                        <h3 class="prize_n">{{ optional($prize)->prize3_amount }}</h3>
                    </div>
                </div>

                <!-- Prize 4 -->
                <div class="col-2 col-md-2">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset('public/images/home/icon4.png')}}" class="img-fluid mb-2" style="max-height:80px;" alt="Prize 4">
                        <h3 class="prize_n">{{ optional($prize)->prize4_amount }}</h3>
                    </div>
                </div>

                <!-- Prize 5 -->
                <div class="col-2 col-md-2">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset('public/images/home/icon5.png')}}" class="img-fluid mb-2" style="max-height:80px;" alt="Prize 5">
                        <h3 class="prize_n">{{ optional($prize)->prize5_amount }}</h3>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mt-3">
                <div class="col-12">
                    <h2 style="font-family: 'NowM', sans-serif; font-size: 20px; color: #fff;" class="text-uppercase">
    @php
        $extraText = app()->getLocale() === 'ar'
            ? (optional($prize)->extra_text_ar ?? 'جوائز إضافية تقدر بـ')
            : (optional($prize)->extra_text_en ?? 'And');
        $extraAmount = optional($prize)->extra_amount ?? '$500k';
    @endphp

    {{ $extraText }} <span style="color: #F8DA58">{{ $extraAmount }}</span>
    @if(app()->getLocale() === 'ar')
        !
    @else
        more
    @endif
</h2>

                </div>
            </div>
        </div>
</section>

{{-- section 6 --}}
<section class="influential-section py-5 text-center">
    <div class="container">
        <!-- Head -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 style="font-family: 'NowB', sans-serif; " class="text-uppercase title_p">
                      <span class="d-md-block">
                          {{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->title_ar : optional($influentialBodySetting)->title_en }}
                      </span>
                </h2>
            </div>
        </div>

        <!-- Logos + Text -->
        <div class="row g-4 justify-content-center align-items-center">
            <!-- Body 1 -->
            <div class="col-6 col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{asset('public/images/home/icon6.png')}}" class="img-fluid mb-2" alt="Body 1">
                    <div class="d-flex flex-column align-items-center">
                        <h3 style="font-family: 'NowM', sans-serif;font-size: 20px ;line-height: 20px">{{ optional($influentialBodySetting)->body1_name }}</h3>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px; line-height: 25px">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body1_description_ar : optional($influentialBodySetting)->body1_description_en }}</p>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px;">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body1_country_ar : optional($influentialBodySetting)->body1_country_en }}</p>
                        <p>  </p>
                    </div>
                </div>
            </div>

            <!-- Body 2 -->
            <div class="col-6 col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{asset('public/images/home/icon8.png')}}" class="img-fluid mb-2" alt="Body 2">
                    <div class="d-flex flex-column align-items-center">
                        <h3 style="font-family: 'NowM', sans-serif;font-size: 20px; line-height: 20px">{{ optional($influentialBodySetting)->body2_name }}</h3>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px; line-height: 25px">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body2_description_ar : optional($influentialBodySetting)->body2_description_en }}</p>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px;">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body2_country_ar : optional($influentialBodySetting)->body2_country_en }}</p>
                    </div>
                </div>
            </div>

            <!-- Body 3 -->
            <div class="col-6 col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{asset('public/images/home/icon9.png')}}" class="img-fluid mb-2" alt="Body 3">
                    <div class="d-flex flex-column align-items-center">
                        <h3 style="font-family: 'NowM', sans-serif;font-size: 20px; line-height: 20px">{{ optional($influentialBodySetting)->body3_name }}</h3>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px; line-height: 25px">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body3_description_ar : optional($influentialBodySetting)->body3_description_en }}</p>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px;">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body3_country_ar : optional($influentialBodySetting)->body3_country_en }}</p>
                    </div>
                </div>
            </div>

            <!-- Body 4 -->
            <div class="col-6 col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{asset('public/images/home/icon7.png')}}" class="img-fluid mb-2" alt="Body 4">
                    <div class="d-flex flex-column align-items-center">
                        <h3 style="font-family: 'NowM', sans-serif;font-size: 20px; line-height: 20px">{{ optional($influentialBodySetting)->body4_name }}</h3>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px; line-height: 25px">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body4_description_ar : optional($influentialBodySetting)->body4_description_en }}</p>
                        <p style="font-family: 'NowM', sans-serif;font-size: 12px;">{{ app()->getLocale() === 'ar' ? optional($influentialBodySetting)->body4_country_ar : optional($influentialBodySetting)->body4_country_en }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






@push('scripts')
<script>



// Simple countdown to 1 Jan 2026
    (function startCountdown() {
        const target = new Date('2026-02-11T00:00:00').getTime();
        const dayEl = document.getElementById('countdown-days');
        const hourEl = document.getElementById('countdown-hours');
        const minuteEl = document.getElementById('countdown-minutes');

        if (!dayEl || !hourEl || !minuteEl) return;

        const tick = () => {
            const now = Date.now();
            let diff = target - now;
            if (diff < 0) diff = 0;

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((diff / (1000 * 60)) % 60);

            dayEl.textContent = days.toString().padStart(2, '0');
            hourEl.textContent = hours.toString().padStart(2, '0');
            minuteEl.textContent = minutes.toString().padStart(2, '0');

            if (diff === 0) clearInterval(intervalId);
        };

        tick();
        const intervalId = setInterval(tick, 1000);
    })();



    function initOwlCarousel() {
        const isRTL = document.documentElement.getAttribute('dir') === 'rtl'; // 👈 نتحقق من الاتجاه الحالي

        $(".owl-carousel").owlCarousel('destroy'); // نحذف أي كاروسيل قديم (عشان نعيد تهيئته)
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            rtl: isRTL, // 👈 مهم جدًا — تفعيل الـ RTL لما الصفحة بالعربية
            navText: [
                "<span class='prev'>&#10094;</span>",
                "<span class='next'>&#10095;</span>"
            ],
            responsive: {
                0: { items: 3 },
                768: { items: 5 }
            }
        });
    }

    $(document).ready(function(){
        // ✅ تشغيل الكاروسيل أول مرة
        initOwlCarousel();

        // ✅ لما المستخدم يغير اللغة (من السكربت اللي فوق)
        window.addEventListener('languageChanged', function() {
            setTimeout(initOwlCarousel, 300); // نعيد تهيئة الكاروسيل بعد تغيير الاتجاه
        });

    });

</script>




@endpush

@endsection
