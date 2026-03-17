@extends('website.layouts.master')

@section('styles')

<style>



    .hero {
        position: relative;
        height: 327px; /* ⬅️ نص الشاشة */
        overflow: hidden;
        background: url("{{ asset('public/images/judge/Judges.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
        text-align: center; /* second part from start */
        font-family: 'NowR', sans-serif;
    }

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

    /* Fixed-height image box so small images fill the area */
    .judge-img {
        height: 380px;
        overflow: hidden;
        border-radius: 12px;
    }

    .judge-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
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
        .judge-img { height: 140px; }
    }

    @media (max-width: 992px) {
        .judge-img { height: 250px; }
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
                   {!!__('judge.real_estate_jury_text')!!}
                </p>
                <!--<p class="col-12 col-md-12 mb-3 headline-center description-text ">-->
                <!--    {{__('judge.real_estate_judging_text')}}-->
                <!--</p>-->
            </div>
        </div>


    </section>

    {{--section 2--}}
    <section class="judges py-5 bg-white">
        <div class="container-fluid">
            <div class="row text-center g-2 justify-content-center">

                <!-- Judge Box -->
                <!--<div class="col-6 col-md-4 custom-col-5">-->
                <!--    <a href="{{url('/judgeProfile')}}" class="text-decoration-none">-->
                <!--    <div class="judge-card p-3">-->
                <!--        <div class="judge-img mb-3">-->
                <!--            <img src="{{ asset('public/images/judge/judge.png') }}" alt="Judge 1">-->
                <!--        </div>-->
                <!--        <h5 class="judge-name mb-1">Mahmoud Ali</h5>-->
                <!--        <p class="judge-title mb-0">CEO & Founder of Triple</p>-->
                <!--        <a class="link" href="#">see more</a>-->
                <!--    </div>-->
                <!--    </a>-->
                <!--</div>-->
                
                
                @foreach($judges as $judge)
                <div class="col-6 col-md-4 custom-col-5">
                    <a href="{{ url('/judgeProfile/' . $judge->id) }}" class="text-decoration-none">
                    <div class="judge-card p-3">
                        <div class="judge-img mb-3">
                            <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $judge->photo }}">
                        </div>
                        <h5 class="judge-name mb-1">{{ $judge->name_en }}</h5>
                        <p class="judge-title mb-0">{{ $judge->title_en }}</p>
                        <a class="link" href="{{ url('/judgeProfile/' . $judge->id) }}">see more</a>
                    </div>
                    </a>
                </div>
                @endforeach
                



            </div>
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-12 mt-5">
                    <a href="{{url('/judgeSubmission')}}"  class="btn btn-light btnColor">{{__('judge.Judge_Submission')}}</a>
                </div>
            </div>
        </div>
    </section>


@endsection
