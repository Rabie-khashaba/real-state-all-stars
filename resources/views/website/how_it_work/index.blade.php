
@extends('website.layouts.master2')

@section('title', 'Registration Form')


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
        .error { border: 2px solid red; }
        .error-message { color: red; font-size: 0.9em; }
        .form-group { margin-bottom: 15px; }
        .progress-ring__circle { display: none; }

        .circle {
            padding: 13px 20px;
            border-radius: 50%;
            background-color: #000;
            color: #fff;
            max-height: 50px;
            z-index: 2;
        }

        .how-it-works.row .col-2 {
            align-self: stretch;
        }



        .how-it-works.row .col-2.full::after {
            height: 100%;
            left: calc(50% - 3px);
        }

        .how-it-works.row .col-2.top::after {
            height: 50%;
            left: 50%;
            top: 0;
        }

        .timeline div {
            padding: 0;
            height: 40px;
        }

        .timeline hr {
            border-top: 3px solid #000;
            margin: 0;
            top: 17px;
            position: relative;
        }

        .timeline .col-2 {
            display: flex;
            overflow: hidden;
        }

        .timeline .corner {
            border: 3px solid #000;
            width: 100%;
            position: relative;
            border-radius: 15px;
        }

        .timeline .top-right {
            left: 50%;
            top: -50%;
        }

        .timeline .left-bottom {
            left: -50%;
            top: calc(50% - 3px);
        }

        .timeline .top-left {
            left: -50%;
            top: -50%;
        }

        .timeline .right-bottom {
            left: 50%;
            top: calc(50% - 3px);
        }

        .how-it-works h5,
        .how-it-works p {
            color: #000;
        }

        .registration-form {
            transition: all 0.3s ease-in-out;
            opacity: 1;
            max-height: none;
            overflow: visible;
            margin-top: 3rem;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .registration-form-hidden {
            display: none !important;
            opacity: 0;
            max-height: 0;
            overflow: hidden;
        }

        .registration-form-visible {
            display: block !important;
            opacity: 1;
            max-height: none;
            overflow: visible;
            animation: slideDown 0.3s ease-in-out;
        }

        .register-btn {
            display: flex !important;
            width: 178px !important;
            height: 48px !important;
            padding: 12px 20px !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 8px !important;
            border-radius: 12px !important;
            background: #000 !important;
            color: #FFF !important;
            font-family: 'Now', sans-serif !important;
            font-size: 16px !important;
            font-style: normal !important;
            font-weight: 500 !important;
            line-height: 24px !important;
            text-decoration: none !important;
            border: none !important;
            transition: background-color 0.3s ease !important;
            margin-bottom: 20px !important;
        }

        .register-btn:hover {
            background-color: #222 !important;
            color: #FFF !important;
        }

        .submit-btn {
            display: flex;
            width: 100%;
            height: 48px;
            padding: 12px 20px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 12px;
            background: #000000ff;
            color: #FFF;
            font-family: 'Now', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
            text-decoration: none;
            border: none;
            transition: background-color 0.3s ease;
            text-transform: none;
        }

        .submit-btn:hover {
            background-color: #222;
            color: #FFF;
        }

        @keyframes slideDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        #toggle-register-form {
            transition: all 0.3s ease;
        }

        #toggle-register-form:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 767.98px) {

            .how-it-works {
                flex-direction: column !important; /* كل شيء عمودي */
                align-items: center; /* توسيط العناصر */
                text-align: center; /* النصوص تتوسط */
            }

            .how-it-works .col-2 {
                width: 100% !important;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 1rem; /* مسافة بين الدائرة والنص */
            }

            .how-it-works .col-md-6 {
                width: 100% !important;
            }

            .timeline {
                display: none !important;
            }

            .how-it-works .col-2::after {
                display: none !important;
            }

            .how-it-works .circle {
                margin: 15px;
                text-align: center !important;
            }

            .how-it-works h5,
            .how-it-works p {
                text-align: center !important;
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

        .title{
            font-family: 'NowB',sans-serif;
            font-size: 18px;
        }

        .description{
            font-family: 'NowM',sans-serif;
            font-size: 15px;
        }
        
        
        /* إذا كانت الصفحة RTL */
        html[dir="rtl"] .timeline .corner.top-right {
            left: auto;
            right: 50%;
        }
        html[dir="rtl"] .timeline .corner.left-bottom {
            left: auto;
            right: -50%;
        }
        html[dir="rtl"] .timeline .corner.top-left {
            left: auto;
            right: -50%;
        }
        html[dir="rtl"] .timeline .corner.right-bottom {
            left: auto;
            right: 50%;
        }
        
        /* إذا أردت عكس الـ hr أيضًا */
        html[dir="rtl"] .timeline hr {
            margin-left: 0;
            margin-right: 0;
        }
    </style>


@section('content')
<main class="content">
    <div class="section-container py-5">
        <div class="container">
            <h2 style="font-family: 'NowM',sans-serif; font-size:25px" class="pb-3 pt-2 border-bottom mb-5 text-center">{{__('how_work.how_it_works')}}</h2>

            {{-- Timeline Steps --}}
            <div class="row align-items-center how-it-works d-flex flex-column flex-md-row">
                <div class="col-2 text-center bottom d-inline-flex justify-content-center align-items-center">
                    <div class="circle font-weight-bold">1</div>
                </div>
                <div class="col-md-6 col-10  text-md-left">
                    <h5 class="title">{{__('how_work.Register')}}</h5>
                    <p class="description">{{__('how_work.Register_desc')}}</p>
                </div>
            </div>

            <div class="row timeline d-none d-md-flex">
                <div class="col-2"><div class="corner top-right"></div></div>
                <div class="col-8"><hr /></div>
                <div class="col-2"><div class="corner left-bottom"></div></div>
            </div>

            <div class="row align-items-center how-it-works d-flex flex-column-reverse flex-md-row justify-content-md-end">
                <div class="col-md-6 col-10  text-md-right">
                    <h5 class="title">{{__('how_work.await_confirmation')}}</h5>
                    <p class="description">{{__('how_work.application_review_desc')}}</p>
                </div>
                <div class="col-2 text-center full d-inline-flex justify-content-center align-items-center">
                    <div class="circle font-weight-bold">2</div>
                </div>
            </div>

            <div class="row timeline d-none d-md-flex">
                <div class="col-2"><div class="corner right-bottom"></div></div>
                <div class="col-8"><hr /></div>
                <div class="col-2"><div class="corner top-left"></div></div>
            </div>

            <div class="row align-items-center how-it-works d-flex flex-column flex-md-row">
                <div class="col-2 text-center top d-inline-flex justify-content-center align-items-center">
                    <div class="circle font-weight-bold">3</div>
                </div>
                <div class="col-md-6 col-10  text-md-left">
                    <h5 class="title">{{__('how_work.Gather_Votes')}}</h5>
                    <p class="description">{{__('how_work.Gather_Votes_desc')}}</p>
                </div>
            </div>

            <div class="row timeline d-none d-md-flex">
                <div class="col-2"><div class="corner top-right"></div></div>
                <div class="col-8"><hr /></div>
                <div class="col-2"><div class="corner left-bottom"></div></div>
            </div>

            <div class="row align-items-center how-it-works d-flex flex-column-reverse flex-md-row justify-content-md-end">
                <div class="col-md-6 col-10  text-md-right">
                    <h5 class="title">{{__('how_work.final_round')}}</h5>
                    <p class="description">{{__('how_work.real_estate_challenge_desc')}}</p>
                </div>
                <div class="col-2 text-center full d-inline-flex justify-content-center align-items-center">
                    <div class="circle font-weight-bold">4</div>
                </div>
            </div>

            @guest
                <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px; margin-top: 2rem;">
                    <a href="{{ url('/contestant/registeration') }}" id="toggle-register-form" class="btn btn-light btn-lg mt-3 mb-3 btncolor">
                        {{__('home.apply_now')}}
                    </a>
                </div>
            @endguest
        </div>


    </div>


</main>
@endsection
