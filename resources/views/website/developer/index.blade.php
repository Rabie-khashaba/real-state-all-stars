@extends('website.layouts.master')

@section('styles')

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        main.flex-fill {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .hero {
            position: relative;
            height: 327px; /* ⬅️ نص الشاشة */
            margin-top: -30px;
            padding-top: 30px;
            box-sizing: border-box;
            overflow: hidden;
            background: url("{{ asset('images/developer/Devlopers.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
                margin-top: -30px;
                padding-top: 30px;
            }

            .hero h1 {
                font-size: 1.6rem;
                line-height: 1.8rem;
            }


        }

        @media (max-width: 991.98px) and (orientation: landscape) {
            .hero {
                height: 220px;
                margin-top: -30px;
                padding-top: 30px;
                background-position: center 30%;
            }

            .hero-content {
                justify-content: center !important;
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }

            .text-wrapper {
                margin-top: 0 !important;
                padding-top: 0 !important;
            }

            .main-heading {
                font-size: 24px;
                line-height: 34px;
                margin-bottom: 0.5rem !important;
            }
        }
        .hero .container {
            padding-left: 40px !important;
            padding-right: 15px !important;
            margin-left: 0;
            margin-right: 0;
            max-width: 100% !important; /* يخليها full width */
        }

        .headline-center {
            display: block;
            text-align: center; /* first part centered */
            font-family: 'NowR', sans-serif;
        }

        .headline-start {
            display: block;
            text-align: left; /* second part from start */
            font-family: 'NowR', sans-serif;
        }

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('font/Now-Bold.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'NowL';
            src: url("{{ asset('font/Now-Light.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'NowM';
            src: url("{{ asset('font/Now-Medium.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'NowTh';
            src: url("{{ asset('font/Now-Thin.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        .main-heading{
            line-height: 60px;
            font-size: 40px;
            font-family: 'NowR', sans-serif;

        }
        .spanText{
            font-family: 'NowB', sans-serif;
            color: #F8DA58;
        }


        @media (max-width: 767px) {
            .main-heading{
                line-height: 50px;
                font-size: 30px;

            }

            .text-wrapper{
                margin-top: 40px;
            }
        }

        .forms{
            border-radius: 12px;
            font-family: 'NowM', sans-serif;
            font-size: 16px;
            width: 100%;
            height: 48px;
        }

        .formf{
            border-radius: 12px;
            font-family: 'NowM', sans-serif;
            font-size: 16px;
           width: 100%;
            height: 48px;
        }

        @media (max-width: 767px) {
            .formf{
                width: 100%;
            }

            .forms option {
                font-size: 14px;   /* قلل حجم الخط */
                padding: 8px;      /* قلل الحشو */
            }

        }


        .card-head{
            font-family: 'NowB', sans-serif;
            font-size: 14px;
            line-height: 28px;
        }

        .card-subhead{
            font-family: 'NowR', sans-serif;
            font-size: 14px;
            line-height: 22px;
            color: #64748B;
        }

        .developer-card-body {
            min-height: 105px;
        }

        .developer-logo-wrap {
            width: 66px;
            height: 64px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #E2E8F0;
            background: #fff;
            flex: 0 0 auto;
        }

        .developer-logo {
            width: 100%;
            height: 60px;
            object-fit: cover;
        }

        @media (max-width: 575.98px) {
            .allCards {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }

            .developer-card-body {
                min-height: auto;
                flex-direction: column;
                justify-content: center !important;
                gap: 0.75rem !important;
                padding: 1rem 0.75rem;
            }

            .developer-card-text {
                width: 100%;
                text-align: center;
            }

            .card-head {
                font-size: 16px;
                line-height: 24px;
                margin-bottom: 0.35rem !important;
            }

            .card-subhead {
                font-size: 13px;
                line-height: 20px;
            }
        }

        .allCards{
            margin-bottom: 100px;
        }

        @media (max-width: 767px) {
            .allCards{
                padding-left: 30px !important;
                padding-right: 30px !important;

            }
        }

        @media (max-width: 991.98px) and (orientation: landscape) {
            .allCards {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .card-body-compact {
                gap: 1rem !important;
                justify-content: flex-start !important;
                padding: 1rem 0.75rem;
            }

            .card-head {
                font-size: 14px;
                line-height: 20px;
            }

            .card-subhead {
                font-size: 12px;
                line-height: 18px;
            }
        }






    </style>
@endsection

@section('content')
    {{--section 1--}}
    <section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->
            <div class="row d-flex flex-column justify-content-center text-white text-center pt-5 text-wrapper">
                <p class="col-12 col-md-12 mt-4 mb-3 pt-3 main-heading">{!! __('developer.competition_pitch_line1') !!}</p>
                <p class="col-12 col-md-12 mb-3 main-heading">{!! __('developer.competition_pitch_line2') !!}</p>
            </div>
        </div>


    </section>

    {{--section 2--}}

    <section class="py-5 bg-white mb-5">
        <div class="container">
            <!-- Filters -->
            <form method="GET" action="{{ route('developers.index') }}">
                <div class="row mb-4 justify-content-between">
                    <div class="col-lg-3 col-md-6 col-6 mb-2">
                        <select class="form-select forms" name="country_id">
                            <option value="">{{ __('developer.all_countries') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-2">
                        <select class="form-select forms" name="area_id">
                            <option value="">{{ __('developer.all_areas') }}</option>
                            @foreach($areas as $area)
                                <option value="{{ $area }}" {{ request('area') == $area ? 'selected' : '' }}>{{ $area->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-2">
                        <select class="form-select forms" name="developer_id">
                            <option value="">{{ __('developer.all_developers') }}</option>
                            @foreach($allDevelopers as $dev)
                                <option value="{{ $dev->id }}" {{ request('developer_id') == $dev->id ? 'selected' : '' }}>{{ $dev->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-2">
                        <button class="btn btn-dark formf" type="submit">{{ __('developer.filter') }}</button>
                    </div>
                </div>
            </form>

            <!-- Cards -->
            <div class="row g-5 px-3 py-4 px-md-5 allCards">
                <!-- Item -->
                @foreach ($developers as $developer )
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{route('developers.show',$developer->id)}}" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <div class="card-body developer-card-body card-body-compact d-flex align-items-center justify-content-center gap-5">

                                <!-- Logo -->
                                <div class="developer-logo-wrap">
                                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->logo }}"
                                        alt="Logo"
                                        class="developer-logo">
                                </div>

                                <!-- Text -->
                                <div class="text-center developer-card-text">

                                    @php
                                        $locale = app()->getLocale();

                                        $name = $locale === 'ar'
                                            ? $developer->name_ar
                                            : $developer->name_en;
                                    @endphp

                                    <h6 class="fw-bold mb-1 card-head">
                                        {{ \Illuminate\Support\Str::limit($name, 10) }}
                                    </h6>
                                    <!--<h6 class="fw-bold mb-1 card-head">{{ $developer->name_en }}</h6>-->
                                    <p class="mb-0 small card-subhead">{{ $developer->projects_count }} {{__('developer.project')}}<br>
                                        {{ $developer->projects->sum('units_count') }} {{__('developer.units')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach




            </div>

        </div>
    </section>



@endsection
