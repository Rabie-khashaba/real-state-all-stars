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
        background: url("{{ asset('images/judge/Judges.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
        line-height: 1.5;

    }

    .headline-start {
        display: block;
        text-align: center; /* second part from start */
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

        line-height: 27px;
        font-size: 37px;
    }
    .spanNumber{
        font-family: 'NowB', sans-serif;
        font-size: 37px;
    }

    .spanText{
        font-family: 'NowR', sans-serif;
        color: #F8DA58
    }
    .description-text{
        font-family: 'NowB', sans-serif;
        font-size: 30px;
        text-transform: uppercase;
        margin-top: 15px;
    }


    @media (max-width: 576px) {

        .main-heading{
            font-size: 24px;
            line-height: 35px;
        }
        .spanNumber{
            font-family: 'NowB', sans-serif;
            font-size: 30px;
        }


        .description-text{
            font-size: 14px;
            text-transform: uppercase;
        }


        .hero .container {
            padding-left: 10px !important;
            padding-right: 10px !important;
            margin-left: 0;
            margin-right: 0;
            max-width: 100% !important; /* يخليها full width */
        }

        .text-wrapper {
            text-align: center !important;
        }
        .headline-start {
            text-align: center !important;
        }



    }


    .judge-card {
        background: #fff;
        border-radius: 12px;
        transition: transform 0.3s ease-in-out;
    }

    .judge-card:hover {
        transform: translateY(-5px);
    }

    .judge-img img {
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .judge-name {
        font-family: 'NowB', sans-serif;
        font-size: 16px;
        font-weight: bold;
    }

    .judge-title {
        font-family: 'NowR', sans-serif;
        font-size: 13px;
        color: #555;
    }
    /* علشان تخلي 5 في السطر */
    .custom-col-5 {
        flex: 0 0 20%;   /* 100 ÷ 5 = 20% */
        max-width: 20%;
    }

    @media (max-width: 992px) {
        .custom-col-5 {
            flex: 0 0 33.333%; /* 3 في السطر */
            max-width: 33.333%;
        }
    }

    @media (max-width: 576px) {
        .custom-col-5 {
            flex: 0 0 50%; /* 2 في السطر */
            max-width: 50%;
        }
    }

    .btnColor{
        background: #000000;
        color: #ffffff;
        border: none;
        font-family: 'NowM',sans-serif;
        font-size: 16px;
        height: 48px;
        width: 178px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 1.5;   /* يخلي النص في النص */

    }

    .judge-name{
        font-family: 'NowB', sans-serif;
        font-size: 20px;
        color: #000000;
    }
    .judge-title{
        font-family: 'NowM', sans-serif;
        font-size: 10px;
    }

    .link{
        font-size: 13px;
        font-family: 'NowB', sans-serif;
        color: #000000;

    }



</style>
@endsection

@section('content')
    {{--section 1--}}
<section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->
            <div class="row d-flex flex-column justify-content-start text-white text-start pt-5 text-wrapper">
                <p class="col-12 col-md-12 mt-4 mb-3 pt-3 main-heading">
                    <span class="headline-center">{!! __('judge.hero_line1') !!}</span><br>
                    <!--<span class="headline-start">{!! __('judge.hero_line2') !!}</span>-->
                </p>
                <!--<p class="col-12 col-md-12 mb-3 headline-center description-text ">-->
                <!--    {!! __('judge.hero_line3') !!}-->
                <!--</p>-->
            </div>
        </div>
</section>

    {{--section 2--}}
    <section class="judges py-5 bg-white">
        <div class="container-fluid">
            <div class="row text-center g-2 justify-content-center">

                <!-- Judge Box -->
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                    <div class="judge-card p-3">
                        <div class="judge-img mb-3">
                            <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                        </div>
                        <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>

                    </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div><div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-4 custom-col-5">
                    <a href="#" class="text-decoration-none">
                        <div class="judge-card p-3">
                            <div class="judge-img mb-3">
                                <img src="{{ asset('images/judge/judge.png') }}" alt="Judge 1">
                            </div>
                            <h5 class="judge-name mb-1">{{ __('judge.guess_who') }}</h5>
                        </div>
                    </a>
                </div>



            </div>
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-12 mt-5">
                    <a href="{{url('/judgeSubmission')}}"  class="btn btn-light btnColor">Judge Submission</a>
                </div>
            </div>
        </div>
    </section>


@endsection
