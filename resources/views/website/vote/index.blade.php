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
            background: url("{{ asset('images/vote/bg.jpg') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
            font-family: 'NowR', sans-serif;
            line-height: 35px;
            font-size: 28px;
            font-weight: 400;
            padding-top: 30px;
        }

        .sub-heading{
            font-family: 'NowR', sans-serif;
            line-height: 35px;
            font-size: 28px;
            font-weight: 400;
        }




        @media (max-width: 576px) {

            .main-heading{
                font-size: 15px;
                line-height: 35px;

            }
            .sub-heading{
                font-size: 15px;
                line-height: 35px;
            }
            .allText{
                margin-top: 30px;
            }


        }


        .custom-vote {
            font-family: 'NowR', sans-serif;

            font-size: 12px; /* عشان النص ي fit */
            line-height: 1;
            background: #FFFFFF;
            color: #000000;
            border-radius: 35px;
            padding-top: 10px ;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .custom-interested {
            font-family: 'NowR', sans-serif;

            padding-top: 10px ;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
            font-size: 12px;
            line-height: 1;
            background: #FFFFFF;
            color: #000000;
            border-radius: 35px;
        }
        .contestant-card {
            width: 200px;
            height: 320px;
            border-radius: 13px;
            overflow: hidden;
            position: relative;

        }

        .contestant-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
        }

        .overlay-content {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 50.18%, rgba(0, 0, 0, 0.8) 100%);
            border-radius: 10px;
            border: #000000 solid 4px;
        }

        .icon-label{
            margin-right: 10px;
        }

        .contestant-buttons{
            margin-bottom: 5px;
        }

        .stage-tabs .nav-link {
            background: #f1f1f1;
            color: #000;
            border-radius: 8px;
            margin: 0 4px;
            font-size: 16px;
            font-weight: 400;
            text-align: center;
            padding: 10px 0;
            font-family: 'NowR', sans-serif;
        }

        .stage-tabs .nav-link.active {
            background: #000;
            color: #fff;
        }

        .search-box {
            border-radius: 10px;
            font-size: 14px;
            height: 46px;
            border: 1px solid #C4C3C3;
        }


        .stage-tabs {
            border-bottom: none !important;
        }

        input::placeholder {
            font-family: 'NowR', sans-serif;
            font-weight: 400;
            font-size: 15px;
            color: #C4C3C3;
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



        .vote-count {
            display: inline-flex;
            align-items: center;
            background-color: #1a1a1a;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border-radius: 20px;
            padding: 3px 10px;
            }

            .vote-count i {
            margin-right: 5px;
            opacity: 0.8;
        }



    /* Video Icons داخل الكارد */
        .overlay-content .video-icons {
            flex-wrap: wrap; /* لو في أكثر من 3 فيديوهات، يلتفوا لصف ثاني */
            justify-content: center;
            margin-top: auto; /* يدفعهم لأسفل داخل overlay */
            padding-bottom: 10px; /* مسافة من أسفل الكارد */
        }

        .overlay-content .video-icons .icon-label img {
            width: 30px;   /* حجم الأيقونة */
            height: 30px;
            object-fit: contain;
        }

        .overlay-content .video-icons .icon-label p {
            margin: 0;
            font-size: 9px;
            color: #fff;
        }


        /* share*/

        .share-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .share-popup {
            background: #fff;
            padding: 25px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease;
            width: 300px;
        }

        .share-popup h5 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .share-buttons a {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .share-buttons a:hover {
            transform: scale(1.1);
            opacity: 0.85;
        }

        /* ألوان المنصات */
        .whatsapp { background-color: #25D366; }
        .facebook { background-color: #1877F2; }
        .twitter  { background-color: #1DA1F2; }

        .copy-link {
            background-color: #f1f1f1;
            color: #333;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .copy-link:hover {
            background-color: #e0e0e0;
        }

        .copy-success {
            color: #28a745;
            margin-top: 10px;
            font-size: 14px;
            display: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }



        .judge-card {
            background: rgba(0, 0, 0, 0.10); /* ⬅️ شفافية عالية جدًا */
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            padding: 0;
        }

        .judge-img img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            filter: blur(1px);   /* ⬅️ شبه واضح */
            opacity: 1;       /* ⬅️ الصورة أوضح */
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            animation: fadeIn 0.4s;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            cursor: pointer;
        }
        .close:hover { color: #000; }
        @keyframes fadeIn { from {opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }
        .modal-content h2 { font-size: 24px; color: #333; font-weight: bold; }

        .video-modal-content {
            max-width: 800px;
            padding: 15px;
        }

        .video-embed-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
        }

        .video-embed-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media (max-width: 576px) {
            .video-modal-content {
                margin: 25% auto;
            }
        }

        .vote-btn:disabled {
            background-color: #e0e0e0;
            color: #999;
            border-color: #ccc;
            cursor: not-allowed;
            opacity: 0.6;
            height:35px !important;

        }

        .vote-btn:disabled:hover {
            background-color: #e0e0e0;
        }

        html[lang="ar"] .stage-tabs {
    gap: 4 !important;   /* يشيل المسافة الزيادة */
    padding-right: 0;   /* مهم */
    margin-right: 0;
}


        @media (max-width: 768px) {
    html[lang="ar"] .stage-tabs .nav-link {
        font-size: 14px; /* صغّر زي ما تحب */
         justify-content: center;   /* توسيط */
    direction: rtl;
    }
}














    </style>
@endsection

@section('content')
    {{--section 1--}}
    <section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->
            <div class="row d-flex flex-column justify-content-center text-white text-center pt-5 allText">
                <p class="col-12 col-md-12  main-heading">
                    {{__('vote.competition_message')}}
                    </p>
                <!--<p class="col-12 col-md-12 mb-3 sub-heading text-center">-->
                <!--    {{__('vote.competition_call_to_action')}}-->
                <!--</p>-->
            </div>
        </div>


    </section>

    {{--section 2--}}


    <section class="container py-5">
        <!-- Stages Tabs -->
        <div class="mb-4">
            <!-- Search -->
            <div class="mb-4 position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                <input type="text" class="form-control ps-5 search-box" placeholder="{{ __('vote.search_contestants_placeholder') }}">
            </div>


            <!-- Tabs -->
            <ul class="nav nav-tabs stage-tabs w-100 gap-4" id="stageTabs" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link active w-100" id="stage1-tab" data-bs-toggle="tab" data-bs-target="#stage1" type="button" role="tab">{{ __('vote.stage_1') }}</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="stage2-tab" data-bs-toggle="tab" data-bs-target="#stage2" type="button" role="tab">{{ __('vote.stage_2') }}</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="stage3-tab" data-bs-toggle="tab" data-bs-target="#stage3" type="button" role="tab">{{ __('vote.stage_3') }}</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="stage4-tab" data-bs-toggle="tab" data-bs-target="#stage4" type="button" role="tab">{{ __('vote.stage_4') }}</button>
                </li>
            </ul>
        </div>

        @if(session('success'))
                            <p class="text-success text-center mb-3">{{ session('success') }}</p>
                        @endif
                        @if(session('error'))
                            <p class="text-danger text-center mb-3">{{ session('error') }}</p>
                        @endif




        <div class="tab-content pt-4" id="stageTabsContent">
            <div class="tab-pane fade show active" id="stage1" role="tabpanel" aria-labelledby="stage1-tab">
                <!-- Tabs Content -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">





                   {{-- @php
                        $stage1Winners = [];
                    @endphp --}}
                    @forelse ($stage1Winners as $stage1Winner)
                        <div class="col">
                            <div class="contestant-card mx-auto position-relative"
                                 style="cursor: pointer;"
                                 onclick="window.location='{{ route('contestant.show', $stage1Winner->user->id) }}'">

                                <!-- Image -->
                                <img src="{{ asset('storage/app/public/' . $stage1Winner->profile_photo_path) }}"
                                     alt="Contestant Image" class="w-100 h-100 object-cover rounded-full contestant-image">

                                <!-- Overlay Content -->
                                <div class="overlay-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between text-white p-1">

                                    <!-- Top Icons -->
                                    <div class="d-flex justify-content-between ">
                                        <a href="javascript:void(0);" class="share-icon-link"
                                           onclick="event.stopPropagation(); openShareOptions('{{ route('contestant.show', $stage1Winner->user->id) }}')">
                                            <div style="width: 18px; height: 18px; color: #000000; font-size: 25px;" class="share-icon">
                                                <i class="bi bi-share-fill"></i>
                                            </div>
                                        </a>

                                        <!--<div class="vote-count">-->
                                        <!--    <i class="fa-solid fa-thumbs-up"></i>-->
                                        <!--    <span class="vote-number">{{ $stage1Winner->votes_count }}</span>-->
                                        <!--</div>-->

                                        <div class="vote-count d-flex align-items-center gap-2">
                                            <img src="{{ asset('images/vote/vote1.svg') }}" alt="Thumbs Up" style="width:24px; height:24px; margin-right:8px;">
                                            <span class="vote-number">{{ $stage1Winner->votes_count }}</span>
                                        </div>

                                    </div>

                                    <!-- Center Content -->
                                    <div class="contestant-body text-start mt-4">
                                        <div class="mt-5 pt-5">
                                            <p style="font-family: 'NowB', sans-serif; font-size: 13px;" class="contestant-name">
                                                {{ $stage1Winner->user->name }}
                                                <span class="verified-badge"><img src="{{asset('images/vote/verified.png')}}"></span>
                                            </p>
                                            <p style="font-family: 'NowR', sans-serif; font-size: 9px;" class="contestant-role">
                                                {{ $stage1Winner->employer  }} | {{ $stage1Winner->user_id + 1000 }}
                                            </p>
                                        </div>

                                        <!-- Video Icons -->
                                        <div class="video-icons d-flex justify-content-center gap-5">
                                            @php
                                                $introVideo = $stage1Winner->videos->firstWhere('stage_number', 0);
                                                $Video1 = $stage1Winner->videos->firstWhere('stage_number', 1);
                                            @endphp
                                            <div class="icon-label text-center">
                                                <a href="{{ $introVideo ? $introVideo->youtube_url : '#' }}" class="video-modal-link" data-youtube-url="{{ $introVideo ? $introVideo->youtube_url : '' }}" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <img src="{{ asset('images/vote/youtube.png') }}">
                                                </a>
                                                <p style="font-family: 'NowR', sans-serif; font-size: 9px;">Introducer</p>
                                            </div>
                                            <div class="icon-label text-center">
                                                <a href="{{ $Video1 ? $Video1->youtube_url : '#' }}" class="video-modal-link" data-youtube-url="{{ $Video1 ? $Video1->youtube_url : '' }}" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <img src="{{ asset('images/vote/youtube.png') }}">
                                                </a>
                                                <p style="font-family: 'NowR', sans-serif; font-size: 9px; color: #ffffff">Video1</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="contestant-buttons d-flex flex-row gap-2 justify-content-center">
                                       {{-- <form action="{{ route('vote', $stage1Winner->id) }}" method="POST" class="vote-form d-inline" onclick="event.stopPropagation();">
                                            @csrf
                                            <button type="submit" class="btn btn-white vote-btn custom-vote">{{__('vote.Vote')}}</button>
                                        </form> --}}


                                       @php
                                        // تحديد آخر مرحلة عند المتسابق رفع فيها فيديو
                                        $contestantHighestStage = $stage1Winner->videos->where('stage_number', '>', 0)->max('stage_number') ?? 1;
                                        // الزر يكون فعال فقط إذا كانت آخر مرحلة عند المتسابق = المرحلة الحالية (1)
                                        $isInHighestStage = ($contestantHighestStage == 1);
                                        // التحقق من وجود فيديو مع youtube_url في آخر مرحلة
                                        $hasVideoWithUrl = $stage1Winner->videos->where('stage_number', $contestantHighestStage)->whereNotNull('youtube_url')->isNotEmpty();
                                        // البحث عن review لهذه المرحلة بالذات
                                        $reviewInHighestStage = $stage1Winner->contestantStageReviews->where('stage_number', $contestantHighestStage)->first();
                                        // إذا لم يوجد review للمرحلة أو يوجد لكن لم يفز → الزر فعال
                                        // إذا يوجد review وفاز → الزر disabled
                                        $hasWonInHighestStage = $reviewInHighestStage && $reviewInHighestStage->is_winner == true;
                                        $canVoteInThisStage = $isInHighestStage && $hasVideoWithUrl && !$hasWonInHighestStage;
                                    @endphp
                                        @if($canVoteInThisStage)
                                            <form action="{{ route('vote', $stage1Winner->id) }}" method="POST" class="vote-form d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-white vote-btn custom-vote">Vote</button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-white vote-btn custom-vote" disabled style="opacity: 0.5; cursor: not-allowed;">Vote</button>
                                        @endif

                                        <form action="{{ route('interest.toggle', $stage1Winner->id) }}" method="POST" class="interest-form d-inline" onclick="event.stopPropagation();">
                                            @csrf
                                            <button type="submit"
                                                    class="btn interested-btn custom-interested"
                                                    @if(auth()->check() && auth()->user()->hasInterested($stage1Winner->id))
                                                        style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                                                    @endif
                                            >
                                                {{__('vote.Interested')}}
                                            </button>
                                        </form>

                                        <p class="vote-message mt-2 text-center text-success" style="display:none;"></p>
                                    </div>

                                </div>
                            </div>


                        </div>

                        @empty

                       <div class="col-6 col-md-4 custom-col-5">
                            <a href="#" class="text-decoration-none judgeCard">
                                <div class="judge-card">
                                    <div class="judge-img">
                                        <img src="{{ asset('images/judge/judge.png') }}" alt="judge">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 custom-col-5">
                            <a href="#" class="text-decoration-none judgeCard">
                                <div class="judge-card">
                                    <div class="judge-img">
                                        <img src="{{ asset('images/judge/judge.png') }}" alt="judge">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 custom-col-5">
                            <a href="#" class="text-decoration-none judgeCard">
                                <div class="judge-card">
                                    <div class="judge-img">
                                        <img src="{{ asset('images/judge/judge.png') }}" alt="judge">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 custom-col-5">
                            <a href="#" class="text-decoration-none judgeCard">
                                <div class="judge-card">
                                    <div class="judge-img">
                                        <img src="{{ asset('images/judge/judge.png') }}" alt="judge">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 custom-col-5">
                            <a href="#" class="text-decoration-none judgeCard">
                                <div class="judge-card">
                                    <div class="judge-img">
                                        <img src="{{ asset('images/judge/judge.png') }}" alt="judge">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Modal -->
                        <div id="judgeModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Get ready to make your voice  heard</h2>
                            </div>
                        </div>
                        @endforelse



                </div>

                <!-- <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination custom-pagination gap-2">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">65</a></li>
                    </ul>
                </div> -->


                <!-- Pagination -->

                @if($stage1Winners instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination custom-pagination gap-2">
                        {{-- Previous Page Link --}}
                        @if ($stage1Winners->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage1Winners->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Page Links --}}
                        @foreach ($stage1Winners->getUrlRange(1, $stage1Winners->lastPage()) as $page => $url)
                            <li class="page-item {{ $stage1Winners->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($stage1Winners->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage1Winners->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            @endif

            </div>



            <div class="tab-pane fade show " id="stage2" role="tabpanel" aria-labelledby="stage2-tab">
                <!-- Tabs Content -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">


                    @foreach ($stage2Winners as $stage2Winner)
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="contestant-card mx-auto position-relative"
                                style="cursor: pointer;"
                                onclick="window.location='{{ route('contestant.show', $stage2Winner->user->id) }}'">
                            <!-- Image -->
                            <img src="{{ asset('storage/app/public/' . $stage2Winner->profile_photo_path) }}" alt="Contestant Image" class="w-100 h-100 object-cover rounded-full contestant-image">

                            <!-- Overlay Content -->
                            <div class="overlay-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between text-white p-1">

                                <!-- Top Icons -->
                                <div class="d-flex justify-content-between ">
                                    <a href="javascript:void(0);" class="share-icon-link"
                                           onclick="event.stopPropagation(); openShareOptions('{{ route('contestant.show', $stage2Winner->user->id) }}')">
                                            <div style="width: 18px; height: 18px; color: #000000; font-size: 25px;" class="share-icon">
                                                <i class="bi bi-share-fill"></i>
                                            </div>
                                        </a>

                                     <div class="vote-count d-flex align-items-center gap-2">
                                            <img src="{{ asset('images/vote/vote1.svg') }}" alt="Thumbs Up" style="width:24px; height:24px; margin-right:8px;">
                                            <span class="vote-number">{{ $stage2Winner->votes_count }}</span>
                                        </div>


                                </div>

                                <!-- Center Content -->
                                <div class="contestant-body text-start mt-4">
                                   <div class="mt-5 pt-5">
                                       <p style="font-family: 'NowB', sans-serif ; font-size: 13px;" class="contestant-name">
                                           {{ $stage2Winner->user->name }} <span  class="verified-badge "><img src="{{asset('images/vote/verified.png')}}"></span>
                                       </p>
                                       <p style="font-family: 'NowR', sans-serif ; font-size: 9px;" class="contestant-role ">{{ $stage2Winner->employer  }} | {{ $stage2Winner->user_id  + 1000 }}</p>
                                   </div>

                                    <!-- Video Icons -->
                                    <div class="video-icons d-flex justify-content-center gap-5">
                                        @php
                                            $stage2Videos = $stage2Winner->videos->where('stage_number', 2)->values(); // كل فيديوهات المرحلة 2
                                        @endphp
                                        <!-- كل فيديوهات المرحلة 2 -->
                                        @foreach($stage2Videos as $key => $video)
                                            <div class="icon-label text-center">
                                                <a href="{{ $video->youtube_url }}" class="video-modal-link" data-youtube-url="{{ $video->youtube_url }}" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <img src="{{ asset('images/vote/youtube.png') }}">
                                                </a>
                                                <p style="font-family: 'NowR', sans-serif ; font-size: 9px; color: #ffffff;">Video {{ $key + 2 }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="contestant-buttons d-flex flex-row gap-2 justify-content-center">
                                   {{-- <form action="{{ route('vote', $stage2Winner->id) }}" method="POST" class="vote-form d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-white vote-btn custom-vote">{{__('vote.Vote')}}</button>
                                    </form> --}}

                                    @php
                                        // تحديد آخر مرحلة عند المتسابق رفع فيها فيديو
                                        $contestantHighestStage = $stage2Winner->videos->where('stage_number', '>', 0)->max('stage_number') ?? 2;
                                        // الزر يكون فعال فقط إذا كانت آخر مرحلة عند المتسابق = المرحلة الحالية (2)
                                        $isInHighestStage = ($contestantHighestStage == 2);
                                        // التحقق من وجود فيديو مع youtube_url في آخر مرحلة
                                        $hasVideoWithUrl = $stage2Winner->videos->where('stage_number', $contestantHighestStage)->whereNotNull('youtube_url')->isNotEmpty();
                                        // البحث عن review لهذه المرحلة بالذات
                                        $reviewInHighestStage = $stage2Winner->contestantStageReviews->where('stage_number', $contestantHighestStage)->first();
                                        // إذا لم يوجد review للمرحلة أو يوجد لكن لم يفز → الزر فعال
                                        // إذا يوجد review وفاز → الزر disabled
                                        $hasWonInHighestStage = $reviewInHighestStage && $reviewInHighestStage->is_winner == true;
                                        $canVoteInThisStage = $isInHighestStage && $hasVideoWithUrl && !$hasWonInHighestStage;
                                    @endphp
                                    @if($canVoteInThisStage)
                                        <form action="{{ route('vote', $stage2Winner->id) }}" method="POST" class="vote-form d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-white vote-btn custom-vote">Vote</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-white vote-btn custom-vote" disabled style="opacity: 0.5; cursor: not-allowed;">Vote</button>
                                    @endif

                                    <form action="{{ route('interest.toggle', $stage2Winner->id) }}" method="POST" class="interest-form d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn interested-btn custom-interested"
                                            @if(auth()->check() && auth()->user()->hasInterested($stage2Winner->id))
                                                style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                                            @endif
                                        >
                                            {{__('vote.Interested')}}
                                        </button>
                                    </form>


                                    <p class="vote-message mt-2 text-center text-success" style="display:none;"></p>

                                </div>
                            </div>
                        </div>


                    </div>
                    @endforeach


                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination custom-pagination gap-2">
                        {{-- Previous Page Link --}}
                        @if ($stage2Winners->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage2Winners->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Page Links --}}
                        @foreach ($stage2Winners->getUrlRange(1, $stage2Winners->lastPage()) as $page => $url)
                            <li class="page-item {{ $stage2Winners->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($stage2Winners->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage2Winners->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>


            <div class="tab-pane fade show " id="stage3" role="tabpanel" aria-labelledby="stage3-tab">
                <!-- Tabs Content -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">


                    @foreach ($stage3Winners as $stage3Winner)
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="contestant-card mx-auto position-relative"
                        style="cursor: pointer;"
                                 onclick="window.location='{{ route('contestant.show', $stage3Winner->user->id) }}'">
                            <!-- Image -->
                            <img src="{{ asset('storage/app/public/' . $stage3Winner->profile_photo_path) }}" alt="Contestant Image" class="w-100 h-100 object-cover rounded-full contestant-image">

                            <!-- Overlay Content -->
                            <div class="overlay-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between text-white p-1">

                                <!-- Top Icons -->
                                <div class="d-flex justify-content-between ">
                                    <a href="javascript:void(0);" class="share-icon-link"
                                           onclick="event.stopPropagation(); openShareOptions('{{ route('contestant.show', $stage3Winner->user->id) }}')">
                                            <div style="width: 18px; height: 18px; color: #000000; font-size: 25px;" class="share-icon">
                                                <i class="bi bi-share-fill"></i>
                                            </div>
                                        </a>

                                     <div class="vote-count d-flex align-items-center gap-2">
                                            <img src="{{ asset('images/vote/vote1.svg') }}" alt="Thumbs Up" style="width:24px; height:24px; margin-right:8px;">
                                            <span class="vote-number">{{ $stage3Winner->votes_count }}</span>
                                        </div>


                                </div>

                                <!-- Center Content -->
                                <div class="contestant-body text-start mt-4">
                                   <div class="mt-5 pt-5">
                                       <p style="font-family: 'NowB', sans-serif ; font-size: 13px;" class="contestant-name">
                                           {{ $stage3Winner->user->name }} <span  class="verified-badge "><img src="{{asset('images/vote/verified.png')}}"></span>
                                       </p>
                                       <p style="font-family: 'NowR', sans-serif ; font-size: 9px;" class="contestant-role ">{{ $stage3Winner->employer  }} | {{ $stage3Winner->user_id  + 1000}}</p>
                                   </div>

                                    <!-- Video Icons -->
                                    <div class="video-icons d-flex justify-content-center gap-3">
                                        @php
                                            $stage3Videos = $stage3Winner->videos->where('stage_number', 3)->values(); // كل فيديوهات المرحلة 2
                                        @endphp
                                        <!-- كل فيديوهات المرحلة 2 -->
                                        @foreach($stage3Videos as $key => $video)
                                            <div class="icon-label text-center">
                                                <a href="{{ $video->youtube_url }}" class="video-modal-link" data-youtube-url="{{ $video->youtube_url }}" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <img src="{{ asset('images/vote/youtube.png') }}">
                                                </a>
                                                <p style="font-family: 'NowR', sans-serif ; font-size: 9px; color: #ffffff;">Video {{ $key + 4 }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="contestant-buttons d-flex flex-row gap-2 justify-content-center">
                                  {{--  <form action="{{ route('vote', $stage3Winner->id) }}" method="POST" class="vote-form d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-white vote-btn custom-vote">{{__('vote.Vote')}}</button>
                                    </form> --}}

                                      @php
                                        // تحديد آخر مرحلة عند المتسابق رفع فيها فيديو
                                        $contestantHighestStage = $stage3Winner->videos->where('stage_number', '>', 0)->max('stage_number') ?? 3;
                                        // الزر يكون فعال فقط إذا كانت آخر مرحلة عند المتسابق = المرحلة الحالية (3)
                                        $isInHighestStage = ($contestantHighestStage == 3);
                                        // التحقق من وجود فيديو مع youtube_url في آخر مرحلة
                                        $hasVideoWithUrl = $stage3Winner->videos->where('stage_number', $contestantHighestStage)->whereNotNull('youtube_url')->isNotEmpty();
                                        // البحث عن review لهذه المرحلة بالذات
                                        $reviewInHighestStage = $stage3Winner->contestantStageReviews->where('stage_number', $contestantHighestStage)->first();
                                        // إذا لم يوجد review للمرحلة أو يوجد لكن لم يفز → الزر فعال
                                        // إذا يوجد review وفاز → الزر disabled
                                        $hasWonInHighestStage = $reviewInHighestStage && $reviewInHighestStage->is_winner == true;
                                        $canVoteInThisStage = $isInHighestStage && $hasVideoWithUrl && !$hasWonInHighestStage;
                                    @endphp
                                    @if($canVoteInThisStage)
                                        <form action="{{ route('vote', $stage3Winner->id) }}" method="POST" class="vote-form d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-white vote-btn custom-vote">Vote</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-white vote-btn custom-vote" disabled style="opacity: 0.5; cursor: not-allowed;">Vote</button>
                                    @endif

                                    <form action="{{ route('interest.toggle', $stage3Winner->id) }}" method="POST" class="interest-form d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn interested-btn custom-interested"
                                            @if(auth()->check() && auth()->user()->hasInterested($stage3Winner->id))
                                                style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                                            @endif
                                        >
                                            {{__('vote.Interested')}}
                                        </button>
                                    </form>


                                    <p class="vote-message mt-2 text-center text-success" style="display:none;"></p>

                                </div>
                            </div>
                        </div>



                    </div>
                    @endforeach


                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination custom-pagination gap-2">
                        {{-- Previous Page Link --}}
                        @if ($stage3Winners->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage3Winners->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Page Links --}}
                        @foreach ($stage3Winners->getUrlRange(1, $stage3Winners->lastPage()) as $page => $url)
                            <li class="page-item {{ $stage3Winners->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($stage3Winners->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage3Winners->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>



            <div class="tab-pane fade show " id="stage4" role="tabpanel" aria-labelledby="stage4-tab">
                <!-- Tabs Content -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">


                    @foreach ($stage4Winners as $stage4Winner)
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="contestant-card mx-auto position-relative"
                            style="cursor: pointer;"
                                 onclick="window.location='{{ route('contestant.show', $stage4Winner->user->id) }}'">
                            <!-- Image -->
                            <img src="{{ asset('storage/app/public/' . $stage4Winner->profile_photo_path) }}" alt="Contestant Image" class="w-100 h-100 object-cover rounded-full contestant-image">

                            <!-- Overlay Content -->
                            <div class="overlay-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between text-white p-1">

                                <!-- Top Icons -->
                                <div class="d-flex justify-content-between ">
                                    <a href="javascript:void(0);" class="share-icon-link"
                                       onclick="event.stopPropagation(); openShareOptions('{{ route('contestant.show', $stage4Winner->user->id) }}')">
                                        <div style="width: 18px; height: 18px; color: #000000; font-size: 25px;" class="share-icon">
                                            <i class="bi bi-share-fill"></i>
                                        </div>
                                    </a>

                                     <div class="vote-count d-flex align-items-center gap-2">
                                            <img src="{{ asset('images/vote/vote1.svg') }}" alt="Thumbs Up" style="width:24px; height:24px; margin-right:8px;">
                                            <span class="vote-number">{{ $stage4Winner->votes_count }}</span>
                                        </div>


                                </div>

                                <!-- Center Content -->
                                <div class="contestant-body text-start mt-4">
                                   <div class="mt-5 pt-5">
                                       <p style="font-family: 'NowB', sans-serif ; font-size: 13px;" class="contestant-name">
                                           {{ $stage4Winner->user->name }} <span  class="verified-badge "><img src="{{asset('images/vote/verified.png')}}"></span>
                                       </p>
                                       <p style="font-family: 'NowR', sans-serif ; font-size: 9px;" class="contestant-role ">{{ $stage4Winner->employer  }} | {{ $stage4Winner->user_id + 1000 }}</p>
                                   </div>

                                    <!-- Video Icons -->
                                    <div class="video-icons d-flex justify-content-center ">
                                        @php
                                            $stage4Videos = $stage4Winner->videos->where('stage_number', 4)->values(); // كل فيديوهات المرحلة 2
                                        @endphp
                                        <!-- كل فيديوهات المرحلة 2 -->
                                        @foreach($stage4Videos as $key => $video)
                                            <div class="icon-label text-center ">
                                                <a href="{{ $video->youtube_url }}" class="video-modal-link" data-youtube-url="{{ $video->youtube_url }}" onclick="event.preventDefault(); event.stopPropagation();">
                                                    <img src="{{ asset('images/vote/youtube.png') }}">
                                                </a>
                                                <p style="font-family: 'NowR', sans-serif ; font-size: 9px; color: #ffffff;">Video {{ $key + 7 }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="contestant-buttons d-flex flex-row gap-2 justify-content-center">
                                   {{-- <form action="{{ route('vote', $stage4Winner->id) }}" method="POST" class="vote-form d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-white vote-btn custom-vote">{{__('vote.Vote')}}</button>
                                    </form> --}}

                                     @php
                                        // تحديد آخر مرحلة عند المتسابق رفع فيها فيديو
                                        $contestantHighestStage = $stage4Winner->videos->where('stage_number', '>', 0)->max('stage_number') ?? 4;
                                        // الزر يكون فعال فقط إذا كانت آخر مرحلة عند المتسابق = المرحلة الحالية (4)
                                        $isInHighestStage = ($contestantHighestStage == 4);
                                        // التحقق من وجود فيديو مع youtube_url في آخر مرحلة
                                        $hasVideoWithUrl = $stage4Winner->videos->where('stage_number', $contestantHighestStage)->whereNotNull('youtube_url')->isNotEmpty();
                                        // البحث عن review لهذه المرحلة بالذات
                                        $reviewInHighestStage = $stage4Winner->contestantStageReviews->where('stage_number', $contestantHighestStage)->first();
                                        // إذا لم يوجد review للمرحلة أو يوجد لكن لم يفز → الزر فعال
                                        // إذا يوجد review وفاز → الزر disabled
                                        $hasWonInHighestStage = $reviewInHighestStage && $reviewInHighestStage->is_winner == true;
                                        $canVoteInThisStage = $isInHighestStage && $hasVideoWithUrl && !$hasWonInHighestStage;
                                    @endphp
                                    @if($canVoteInThisStage)
                                        <form action="{{ route('vote', $stage4Winner->id) }}" method="POST" class="vote-form d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-white vote-btn custom-vote">Vote</button>
                                        </form>
                                    @else
                                        <button type="" class="btn btn-white vote-btn custom-vote" disabled style="opacity: 0.5; cursor: not-allowed;">Vote</button>
                                    @endif

                                    <form action="{{ route('interest.toggle', $stage4Winner->id) }}" method="POST" class="interest-form d-inline">
                                        <button type="submit"
                                            class="btn interested-btn custom-interested"
                                            @if(auth()->check() && auth()->user()->hasInterested($stage4Winner->id))
                                                style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                                            @endif
                                        >
                                            {{__('vote.Interested')}}
                                        </button>
                                    </form>


                                    <p class="vote-message mt-2 text-center text-success" style="display:none;"></p>

                                </div>
                            </div>
                        </div>



                    </div>
                    @endforeach


                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination custom-pagination gap-2">
                        {{-- Previous Page Link --}}
                        @if ($stage4Winners->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage4Winners->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Page Links --}}
                        @foreach ($stage4Winners->getUrlRange(1, $stage4Winners->lastPage()) as $page => $url)
                            <li class="page-item {{ $stage4Winners->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($stage2Winners->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $stage4Winners->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>




    </section>

    <div id="videoModal" class="modal">
        <div class="modal-content video-modal-content">
            <span class="close video-modal-close">&times;</span>
            <div class="video-embed-wrapper">
                <iframe id="videoModalIframe" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>





@endsection



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vote AJAX


    // Interested AJAX
    document.querySelectorAll('.interest-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let url = form.action;
            let token = form.querySelector('input[name="_token"]').value;
            let button = form.querySelector('button');
            let messageEl = form.nextElementSibling;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(res => res.json())
            .then(data => {
                /* messageEl.style.display = 'block';
                messageEl.textContent = data.message; */
                if (data.isInterested) {
                    button.style.background = 'linear-gradient(90deg, #F8DA58, #C79720)';
                    button.style.color = '#000';
                } else {
                    button.style.background = '';
                    button.style.color = '';
                }
            })
            .catch(err => console.error(err));
        });
    });
});



</script>


@php
    $messages = [
        'shareMessage' => __('popup.share_contestant'),
        'shareTitle'   => __('popup.share_via'),
        'copyBtn'      => __('popup.copy_link'),
        'copySuccess'  => __('popup.copy_success'),
    ];
@endphp

<script>
    const messages = {!! json_encode($messages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!};

    function openShareOptions(url) {
        const encoded = encodeURIComponent(messages.shareMessage + ' ' + url);
        const whatsapp = `https://wa.me/?text=${encoded}`;
        const facebook = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        const twitter = `https://twitter.com/intent/tweet?text=${encoded}`;

        // احذف أي popup قديم
        document.querySelectorAll('.share-popup-overlay').forEach(el => el.remove());

        const popup = `
            <div class="share-popup-overlay" onclick="this.remove()">
                <div class="share-popup" onclick="event.stopPropagation()">
                    <h5>${messages.shareTitle}</h5>
                    <div class="share-buttons">
                        <a href="${whatsapp}" class="whatsapp" target="_blank"><i class="bi bi-whatsapp"></i></a>
                        <a href="${facebook}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="${twitter}" class="twitter" target="_blank"><i class="bi bi-x"></i></a>
                    </div>
                    <button class="copy-link" onclick="copyToClipboard('${url}', this)"> ${messages.copyBtn}</button>
                    <div class="copy-success">${messages.copySuccess}</div>
                </div>
            </div>`;
        document.body.insertAdjacentHTML('beforeend', popup);
    }

    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const successMsg = btn.nextElementSibling;
            successMsg.style.display = 'block';
            setTimeout(() => {
                successMsg.style.display = 'none';
            }, 2000);
        });
    }
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("judgeModal");
    const cards = document.querySelectorAll(".judgeCard");
    const closeBtn = modal.querySelector(".close");

    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = "block";
        });
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = "none";
    });

    window.addEventListener('click', function(e) {
        if(e.target == modal) modal.style.display = "none";
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('videoModal');
    const videoIframe = document.getElementById('videoModalIframe');
    const closeBtn = document.querySelector('.video-modal-close');
    const videoLinks = document.querySelectorAll('.video-modal-link');

    function getYouTubeEmbedUrl(url) {
        if (!url) return '';
        const shortMatch = url.match(/youtu\.be\/([^\s?&]+)/);
        const watchMatch = url.match(/[?&]v=([^\s?&]+)/);
        const embedMatch = url.match(/youtube\.com\/embed\/([^\s?&]+)/);
        const videoId = (shortMatch && shortMatch[1]) || (watchMatch && watchMatch[1]) || (embedMatch && embedMatch[1]);
        return videoId ? `https://www.youtube.com/embed/${videoId}?autoplay=1` : '';
    }

    function closeVideoModal() {
        videoModal.style.display = 'none';
        videoIframe.src = '';
    }

    videoLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const url = link.getAttribute('data-youtube-url') || link.href;
            const embedUrl = getYouTubeEmbedUrl(url);
            if (!embedUrl) return;
            videoIframe.src = embedUrl;
            videoModal.style.display = 'block';
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeVideoModal);
    }

    window.addEventListener('click', function(e) {
        if (e.target === videoModal) {
            closeVideoModal();
        }
    });
});
</script>
