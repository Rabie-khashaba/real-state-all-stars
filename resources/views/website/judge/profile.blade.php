@extends('website.layouts.master2')

@section('styles')

    <style>


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
        .judge-name {
            font-family: 'NowB', sans-serif;
            font-size: 34px;
            line-height: 24px;
        }

        .judge-title {
            font-family: 'NowM', sans-serif;
            font-size: 10px;
            color: #000000;
            line-height: 24px;

        }

        .judge-description {
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            line-height: 34px;
        }

        @media (max-width: 992px) {
            .judge-description {
                font-size: 12px;
                line-height: 20px;
            }
        }

    /*    */


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

        .judge-nameImg {
            font-family: 'NowB', sans-serif;
            font-size: 16px;
            font-weight: bold;
        }

        .judge-titleImg {
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



        .judge-nameImg{
            font-family: 'NowB', sans-serif;
            font-size: 20px;
            color: #000000;
        }
        .judge-titleImg{
            font-family: 'NowM', sans-serif;
            font-size: 10px;
        }

        .link{
            font-size: 13px;
            font-family: 'NowB', sans-serif;
            color: #000000;

        }

.judge-description {
    font-family: 'NowR', sans-serif;
    font-size: 16px;
    line-height: 34px;

    white-space: normal;          /* خلي النص يتلف طبيعي */
    word-wrap: break-word;        /* لو في كلمة طويلة تتقسّم */
    overflow-wrap: break-word;    /* نفس الفكرة بس أحدث */
}


.profile-img {
    width: 100%;
    max-width: 380px;
    height: 450px;
    object-fit: cover;
    border-radius: 12px;
}


@media (max-width: 768px) {
    .profile-img {
        width: 100%;
        height: 260px;
    }
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


@media (max-width: 992px) {
        .judge-img { height: 250px; }
    }

    </style>
@endsection

@section('content')

{{-- section 1--}}
    <section class="judge-profile py-4 bg-white">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- العمود الأول: الصورة -->
                <div class="col-12 col-md-4 text-center">
                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $judge->photo }}"
                         alt="{{ $judge->name }}"
                         class="profile-img img-fluid">
                </div>

                <!-- العمود الثاني: النص -->
                <div class="col-12 col-md-8">
                    <div class="d-flex align-items-center mb-2 flex-wrap">

                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $judge->logo  }}"
                             alt="Logo"
                             class="me-2  img-fluid"
                             style="height: 63px; max-width: 63px;">

                        <div class="mt-3">
                            <h3 class="judge-name mb-0 flex-grow-1">{{ $judge->name }}</h3>
                            <p class="judge-title mb-3">{{ $judge->title }}</p>
                        </div>


                    </div>


                    <p class="judge-description">{!! nl2br(e($judge->bio)) !!}</p>
                </div>

            </div>
            <hr class="mt-5">
        </div>


    </section>

{{-- section 2--}}
    <section class="judges py-0 bg-white">
        <div class="container-fluid">
            <div class="row text-center g-2 justify-content-center">

                <div style="font-family: 'NowB', sans-serif;font-size: 30px; text-transform: uppercase" class="text-center">
                    <h2>Meet the Judges</h2>
                </div>

                <!-- Other judges (exclude current) -->
                @foreach($otherJudges as $other)
                    <div class="col-6 col-md-4 custom-col-5">
                        <a href="{{ route('judge.profile', $other->id) }}" class="text-decoration-none">
                            <div class="judge-card p-3">
                                <div class="judge-img mb-3">
                                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $other->photo }}">
                                </div>
                                <h5 class="judge-nameImg mb-1">{{ $other->name }}</h5>
                                <p class="judge-titleImg mb-0">{{ $other->title }}</p>
                                <a class="link" href="{{ route('judge.profile', $other->id) }}">see more</a>
                            </div>
                        </a>
                    </div>
                @endforeach



            </div>
        </div>
    </section>


@endsection
