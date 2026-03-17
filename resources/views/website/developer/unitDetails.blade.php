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

        .alldiv{
            margin-left: 50px;
        }

        @media (max-width: 768px) {
            .alldiv{
                margin-left: 0px;
            }
        }

        .btnsRight{
            width: 200px;
            height: 56px;
            background-color: #000000;
            color: #ffffff;
            border-radius: 16px;
            padding-top: 16px;
            padding-bottom: 16px;
            padding-left: 24px;
            padding-right:24px
            text-align: center;
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            font-weight: 500;
        }
        .btncolor{
            color: #000000;
            background: linear-gradient(90deg, #C79720, #F8DA58);
        }

        @media (max-width: 768px) {
            .btnsRight{
                width: 100%;
            }
        }

        @media (min-width: 768px) {
            .big-img {
                height: 570px !important;
            }
        }

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

        .parentDiv{
            height: 90px;
            padding-top: 16px;
            padding-bottom:16px ;
            padding-left:24px ;
            padding-right:24px ;
            border-radius: 16px;
        }

        .numbold{
            font-size: 25px ;
            font-family: 'NowB', sans-serif
        }

        .childDiv{
            font-size: 12px ;
            font-family: 'NowM', sans-serif
        }

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        
        /* الصف الأساسي يخلي العمودين بنفس الطول */
        .row.align-items-stretch > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .unit-gallery {
            --gallery-height: auto;
            --gallery-gap: 16px;
        }

        @media (min-width: 768px) {
            .unit-gallery {
                --gallery-height: 520px;
            }
        }

        .right-images {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: var(--gallery-gap);
            height: var(--gallery-height);
        }

        .right-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--gallery-gap);
        }

        .right-item,
        .right-bottom {
            min-height: 0;
        }
        
        /* الصورة الكبيرة تملى العمود بالكامل */
        .big-img {
            width: 100%;
            height: var(--gallery-height);
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            flex-grow: 1;
        }
        
        /* الصور الصغيرة */
        .small-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            display: block;
        }
        
        /* الموبايل */
        @media (max-width: 767px) {
            .unit-gallery {
                --gallery-gap: 12px;
            }

            .right-images {
                height: auto;
                grid-template-rows: auto auto;
                flex: 0 0 auto;
            }

            .big-img,
            .small-img {
                height: auto !important;
            }
        }



    </style>






@endsection

@section('content')

    <section class="py-5">
        <div class="container">


            <div class="row g-3">

           <!-- العمود الأول: الصورة الكبيرة -->
<div class="row g-3 align-items-stretch unit-gallery">
    <!-- العمود الأول: الصورة الكبيرة -->
    <div class="col-12 col-md-6 d-flex">
        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $unit->main_photo }}"
             class="big-img flex-fill"
             alt="Large Image">
    </div>

 

    <div class="col-12 col-md-6 d-flex flex-column">
        <div class="right-images flex-fill">
            <div class="right-top">
                    <div class="right-item">
                        <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $unit->photo_1 }}"
                             class="small-img"
                             alt="Small Image 1">
                    </div>
                
                    <div class="right-item">
                        <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $unit->photo_2 }}"
                             class="small-img"
                             alt="Small Image 2">
                    </div>
                
            </div>

                <div class="right-bottom">
                    <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $unit->photo_3 }}"
                         class="small-img"
                         alt="Bottom Image">
                </div>
            
        </div>
    </div>
</div>




            </div>
        </div>
    </section>

    <section class="py-3 mb-3 mt-4 bg-white">
        <div class="container">
            <div class="row g-5 align-items-start">

                <!-- العمود الشمال (العنوان + collapse) -->
                <div class="col-12 col-md-8 order-1 order-md-1 alldiv">
                    <div class="d-flex flex-wrap align-items-center">
                        <img
                            src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . ($unit->project->developer->logo ?? 'images/developer/Ellipse.png') }}"
                            alt="..."
                            class="img-fluid me-2"
                            style="width:48px; height:48px; object-fit:cover;"
                        >
                        <div class="ms-1">
                            <h2 class="fw-semibold mb-2" style="font-size: 30px; line-height: 28px;">{{ app()->getLocale() === 'ar' ? $unit->name_ar : $unit->name_en }}</h2>

                            <div class="d-flex align-items-center mb-2">
                            <a href="{{ $unit->map_url ? $unit->project->map_url : '#' }}"
                                target="_blank"
                                >
                                    <img src="{{ asset('public/images/developer/location.png') }}"
                                        alt="Location"
                                        style="width: 20px; height: 20px;">
                                </a>  
                                    <span style="font-family: 'NowR', sans-serif; font-size: 16px;">
                                    @php
                                        $locale = app()->getLocale();
                                    @endphp
                                    
                                    <span style="font-family: 'NowR', sans-serif; font-size: 16px;">
                                        {{
                                            $locale === 'ar'
                                            ? ($unit->project?->city?->name_ar ?? $unit->project?->area?->name_ar ?? '')
                                            : ($unit->project?->city?->name_en ?? $unit->project?->area?->name_en ?? '')
                                        }}
                                    </span>
                                </span>
                            </div>

                            <h2 class="fw-semibold" style="font-size: 25px;">{{$unit->price}} EGP</h2>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h2 style="font-size: 20px; font-family: 'NowB', sans-serif; line-height: 28px;">About Apartment</h2>
                        <p style="font-family: 'NowR', sans-serif; font-size: 16px;">
                                {!! nl2br(e(app()->getLocale() === 'ar' ? $unit->about_ar : $unit->about_en)) !!}
                        </p>
                    </div>

                    <hr class="mt-4" style="width: 100%; height: 2px; background: #000000;">
                </div>

                <!-- العمود اليمين (الأزرار) -->
               <div class="col-md-3 order-2 order-md-2 d-flex flex-column justify-content-center gap-2 btns">
                    <a href="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $unit->master_plan}}" target="_blank" class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                        <img src="{{asset('public/images/developer/details/Vector.png')}}" alt=""> Master Plan
                    </a>
                    <a href="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $unit->brochure}}" target="_blank" class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                        <img src="{{asset('public/images/developer/details/brochure.png')}}" alt=""> Brochure
                    </a>
                    <a href="{{ $unit->project->map_url ? $unit->map_url : '#' }}" target="_blank" class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                        <img src="{{asset('public/images/developer/details/maps (1).png')}}" alt=""> View in Map
                    </a>
                    <a class="btn btn-light btnsRight btncolor">Interested</a>
                </div>

            </div>
        </div>
    </section>


    <section >
        <div class="container mb-5">

                <h2 class="fw-bold mb-4 text-start mx-5" style="font-family: 'NowB', sans-serif; font-size: 20px">Payment Plans</h2>
                <div class=" my-3 mb-5 mx-5">
                    <div class="row g-4">
                        <!-- Plan 1 -->
                        <div class="col-md-4 col-12" style="cursor: pointer">
                            <div class="bg-dark text-white  d-flex justify-content-between align-items-center parentDiv">
                                <div class="numbold">{{ intval($unit->down_payment_percentage) }}%
                                    <div class="childDiv">Down Payment</div>
                                </div>
                                <div  class="mt-2">
                                    <div class="childDiv" > <span class="numbold">{{$unit->number_of_years}}</span> Years</div>
                                </div>
                            </div>
                        </div>

                        <!-- Plan 2 -->

                        {{-- <div class="col-md-4 col-12" style="cursor: pointer">
                            <div class="bg-dark text-white  d-flex justify-content-between align-items-center parentDiv">
                                <div class="numbold">5%
                                    <div class="childDiv">Down Payment</div>
                                </div>
                                <div  class="mt-2">
                                    <div class="childDiv" > <span class="numbold">9</span> Years</div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>


            <h4 style="font-family: 'NowB', sans-serif; font-size: 30px;line-height: 20px ; text-transform: uppercase" class="text-center mb-3 fw-bold">explore other units</h4>

            <div class="row g-4">
                
                @foreach ($projectUnits as $unit)
                
                
                @php
                   // عرض اسم النوع حسب اللغة الحالية
                    $unitTypeName = app()->getLocale() === 'ar'
                        ? ($unit->unitType->type_ar ?? 'غير محدد')
                        : ($unit->unitType->type_en ?? 'Unknown');
        
                    // نستخدم النوع كـ class للفلترة (بالإنجليزية لتفادي مشاكل الحروف)
                    $unitTypeSlug = Str::slug($unit->unitType->type_en ?? 'unknown', '_');
                @endphp
                
                <div class="col-md-4 unit-card {{ $unitTypeSlug }}">
                    <a href="{{ route('unit.details', $unit->id) }}" class="text-decoration-none text-dark">

                        <div class="property-card ">
                            <div class="image-wrapper">
                                <span class="unit-badge">{{ $unitTypeName }}</span>
                                <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $unit->main_photo }}" alt="Villa" class="card-img">
                                <div class="overlay"></div>
                            </div>
                            <div class="card-body p-3">
                    <h5 class="mb-3 fw-semibold" style="font-size:24px; color:#000;">
                        {{ $unit->name ?? 'Unnamed Unit' }}
                    </h5>
                    <div class="d-flex align-items-center text-muted small" style="font-size:13px; color:#6c757d;">

                        <!-- Bedrooms -->
                        <div class="d-flex align-items-center gap-1 me-3">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke2.png') }}" alt="bed" width="16" class="me-1">
                            <span>{{ $unit->bedrooms ?? '-' }} bd</span>
                            <img  src="{{ asset('public/images/developer/units/icons/Frame.png') }}" alt="bath"  class="ms-3">
                        </div>

                        <!-- Bathrooms -->
                        <div class="d-flex align-items-center me-3">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke.svg') }}" alt="bath" width="16" class="me-1">
                            <span>{{ $unit->bathrooms ?? '-' }} ba</span>
                            <img  src="{{ asset('public/images/developer/units/icons/Frame.png') }}" alt="bath"  class="ms-3">
                        </div>

                        <!-- Size -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('public/images/developer/units/icons/Stroke3.png') }}" alt="area" width="16" class="me-1">
                            <span>{{ $unit->area ?? '-' }} ft</span>
                        </div>

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

@section('script')

@endsection
