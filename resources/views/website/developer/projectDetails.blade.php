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




        .custom-tabs {
            border-bottom: 2px solid #E5E7EB; /* خط رمادي */
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        /* كل nav-item ياخد نفس العرض */
        .custom-tabs .nav-item {
            flex: 1 1 0;
            text-align: center;
        }

        /* تصميم الزر */
        .custom-tabs .nav-link {
            border: none;
            background: transparent;
            font-family: 'NowB', sans-serif;
            font-size: 16px;
            color: #64748B;
            position: relative;
            padding-bottom: 12px;
            width: 100%; /* يخلي الزر يملأ عرض العمود */
        }

        /* الـ Active */
        .custom-tabs .nav-link.active {
            color: #000;
            font-weight: bold;
        }

        .custom-tabs .nav-link.active::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -15px;
            transform: translateX(-50%);
            width: 100%;   /* الخط تحت التاب */
            height: 2px;
            background-color: #000;
            border-radius: 2px;
        }

        .custom-tabs .nav-link{
            font-family: 'NowB', sans-serif;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .custom-tabs .nav-link.active::after {
                content: "";
                position: absolute;
                left: 50%;
                bottom: -15px;
                transform: translateX(-50%);
                width: 100%;   /* الخط تحت التاب */
                height: 2px;
                background-color: #000;
                border-radius: 2px;
            }
        }


             /* ارتفاع ثابت بس للديسكتوب */



        .filter-btn{
            height:34px ;
            width:112px ;
            border-radius: 25px;
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            background: #B7B7B7;
            border: none;
            margin: 15px;

        }

        @media (max-width: 768px) {
            .filter-btn{
                height:34px ;
                width:112px ;
                border-radius: 25px;
                font-family: 'NowR', sans-serif;
                font-size: 16px;
                background: #B7B7B7;
                border: none;
                margin: 0px;
        }}


        .property-card {
            border-radius: 24px;
            overflow: hidden; /* يخلي أي حاجة جوه الكارد تاخد نفس الـ radius */
            background: #fff;
            transition: transform 0.3s ease;
            cursor: pointer;


        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .image-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            border-radius: 24px; /* 👈 نفس الـ radius */
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 24px; /* 👈 نفس الـ radius */
        }

        .image-wrapper .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5); /* طبقة رمادية */
            transition: opacity 0.3s ease;
            opacity: 1;
            border-radius: 24px; /* 👈 نفس الـ radius */
        }

        .property-card:hover .overlay {
            opacity: 0; /* تختفي عند Hover */
        }

        .unit-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #000; /* لون أسود زي الصورة */
            color: #fff;
            font-family: 'Nowٌ', sans-serif;
            font-size: 16px;
            padding: 6px 14px;
            border-radius: 20px;
            z-index: 2;
            text-transform: uppercase; /* تخلي النص كابيتال */
        }

        .cartSt{
            border-radius: 10px;
            overflow: hidden;
        }

        .headCard{
            font-family: 'NowB', sans-serif;
            font-size: 35px;
        }
        @media (max-width: 768px) {
            .headCard{
                font-size: 25px;
            }
        }

    </style>



@endsection

@section('content')
    <section class="py-5 bg-white">
        <div class="container">
            
            
            <div class="d-flex mb-4 align-items-center">
                <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $project->developer->logo }}"
                     alt="..."
                     style="width:48px; height:48px; object-fit:cover; margin-right:10px;">

                <div>
                    <h2 style="font-family: 'NowB', sans-serif; font-size: 25px;line-height: 28px" class="mb-1">{{ app()->getLocale() === 'ar' ? ($project->developer->name_ar ?? '') : ($project->developer->name_en ?? '') }}</h2>
                    <span style="width: 20px;height: 20px">
                    <img src="{{ asset('public/images/developer/location.png') }}"
                                alt="Location"
                                style="width: 20px; height: 20px;">

                    </span> <span style="font-family: 'NowR', sans-serif; font-size: 16px">
                        {{ app()->getLocale() === 'ar' ? ($project->city->name_ar ?? '') : ($project->city->name_en ?? '') }}
                        
                        </span>
                </div>
            </div>
            <!-- Tabs -->
            <ul class="nav nav-tabs custom-tabs justify-content-between" id="myTab" role="tablist">
                <li  class="nav-item tabBtn" role="presentation">
                    <button class="nav-link active " id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                            type="button" role="tab">{{ __('developer.project_details') }}</button>
                </li>
                <li class="nav-item tabBtn" role="presentation">
                    <button class="nav-link " id="units-tab" data-bs-toggle="tab" data-bs-target="#units"
                            type="button" role="tab">{{ __('developer.units') }}</button>
                </li>
                <li class="nav-item tabBtn" role="presentation">
                    <button class="nav-link " id="video-tab" data-bs-toggle="tab" data-bs-target="#video"
                            type="button" role="tab">{{ __('developer.contestants_video') }}</button>
                </li>
            </ul>

            <!-- Content -->
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="details" role="tabpanel">
                    @include('website.developer.details')
                </div>
                
                
                <div class="tab-pane fade" id="units" role="tabpanel">
                    <!-- Filter Buttons -->
                    <div class="text-center mb-5 filter-btns ">
                        @php
                            // نحمّل علاقة unitType لجميع الوحدات لتقليل الاستعلامات
                            $units = $project->units->load('unitType');

                            // نختار نوع الاسم حسب اللغة الحالية
                            $locale = app()->getLocale();
                            $typeColumn = $locale === 'ar' ? 'unitType.type_ar' : 'unitType.type_en';

                            // نجيب الأنواع المميزة فقط
                            $unitTypes = $units->pluck($typeColumn)->unique()->filter();
                        @endphp
                        
                            {{-- زر ALL ثابت --}}
                        <button class="btn btn-outline-dark filter-btn active" data-filter="all">    {{ __('developer.all') }}</button>

                        {{-- توليد الأزرار من أنواع الوحدات --}}
                        @foreach ($unitTypes as $typeName)
                        @php
                            // نستخدم slug إنجليزي للفلترة لتفادي الحروف العربية في الكلاسات
                            $typeSlug = Str::slug($typeName, '_');
                        @endphp
                            @if ($typeName)
                                <button class="btn btn-outline-dark filter-btn" data-filter="{{ $typeSlug }}">
                                    {{ $typeName }}
                                </button>
                            @endif
                        @endforeach
                    </div>

                    <h4 style="font-family: 'NowB', sans-serif; font-size: 35px;line-height: 20px" class="text-center mb-5 fw-bold">{{__('developer.Explore All Units')}}</h4>

                    <div class="row g-4">
                        <!-- Cards -->
                        @include('website.developer.allUnits')

                    </div>
                </div>
               {{-- <div class="tab-pane fade" id="video" role="tabpanel">
                    <h2 class="text-center mb-5 headCard">
                        CONTESTANTS TALK ABOUT THIS PROJECT
                    </h2>

                    <!-- شبكة الفيديوهات -->
                    <div class="row g-4">
                        <!-- فيديو 1 -->
                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY?modestbranding=1&rel=0&showinfo=0"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- فيديو 2 -->
                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- فيديو 3 -->
                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-3">
                            <div class="card border-0 cartSt">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                        title="YouTube video"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- كرر باقي الفيديوهات -->
                    </div>
                </div> --}}
                
                <div class="tab-pane fade" id="video" role="tabpanel">
                    <h2 class="text-center mb-5 headCard">
                        {{__('developer.CONTESTANTS TALK ABOUT THIS PROJECT')}}
                    </h2>

                    <!-- شبكة الفيديوهات -->
                    <div class="row g-4">
                        @if($videos && $videos->count() > 0)
                            @foreach($videos as $video)
                                @php
                                    // تحويل رابط YouTube إلى رابط embed
                                    $youtubeUrl = $video->youtube_url;
                                    $embedUrl = $youtubeUrl;

                                    // إذا كان الرابط يحتوي على watch?v= أو youtu.be/
                                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $youtubeUrl, $matches)) {
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.youtube.com/embed/{$videoId}?modestbranding=1&rel=0&showinfo=0";
                                    } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $youtubeUrl, $matches)) {
                                        // إذا كان الرابط بالفعل embed
                                        $videoId = $matches[1];
                                        $embedUrl = "https://www.youtube.com/embed/{$videoId}?modestbranding=1&rel=0&showinfo=0";
                                    } elseif (strpos($youtubeUrl, 'youtube.com/embed/') === false && strpos($youtubeUrl, 'youtu.be/') === false && strpos($youtubeUrl, 'youtube.com/watch') === false) {
                                        // إذا لم يكن رابط YouTube صحيح، استخدم الرابط كما هو
                                        $embedUrl = $youtubeUrl;
                                    }
                                @endphp
                                <div class="col-12 col-md-3">
                                    <div class="card border-0 cartSt">
                                        <div class="ratio ratio-16x9">
                                            <iframe
                                                src="{{ $embedUrl }}"
                                                title="YouTube video"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-center text-muted">    {{ __('developer.no_videos') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Filtering Script -->
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                let filter = this.getAttribute('data-filter');
                document.querySelectorAll('.unit-card').forEach(card => {
                    if(filter === 'all' || card.classList.contains(filter)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>







@endsection

