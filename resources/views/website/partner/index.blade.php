@extends('website.layouts.master2')

@section('styles')
    <style>

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

         /* ====== LOGO CAROUSEL ====== */
   /* ====== LOGO CAROUSEL ====== */
   :root {
        --logo-size: 120px;
        --logo-gap: 22px;
    }

    .logo-carousel {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        padding: 20px 0;
        display: flex;
        justify-content: center; /* العناصر كلها في المنتصف */
        align-items: center;
    }

    .logo-track {
        display: flex;
        gap: var(--logo-gap);
        align-items: center;
        width: max-content;
        animation: slide 18s linear infinite;
        justify-content: center; /* العناصر في المنتصف */
    }

    @keyframes slide {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    .logo-card {
        flex: 0 0 auto;
        width: var(--logo-size);
        height: var(--logo-size);
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        border: 2px solid #E2E8F0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .logo-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        :root {
            --logo-size: 80px;
            --logo-gap: 16px;
        }
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




        .nav-pills .nav-link.active {
            color: #ffffff !important;
            background-color: #000000 !important;
            border: none;
            /* لو حابب تضيف حدود خفيفة ممكن تفتح السطر تحت */
            /* border: 1px solid #ccc; */
        }
        /* الحالة العادية - ديسكتوب */
        .nav-pills .nav-link {
            color: black !important;
            background-color: #D9D9D9 !important;
            border: none;
            height: 44px;
            font-family: 'NowM', sans-serif;
            font-size: 18px;
            border-radius: 12px;
            width: 209px;
            text-align: center;

        }



        /* شاشات أصغر من 768px */
        @media (max-width: 768px) {
            .nav-pills .nav-link {
                width: 100px;
                font-size: 12px;
            }

            .tab-text{
                font-size: 11px;
                white-space: nowrap;
            }

            /*.tab-text {*/
            /*    visibility: hidden;*/
            /*    position: relative;*/
            /*}*/

            /*.tab-text::before {*/
            /*    content: 'Partner';*/
            /*    visibility: visible;*/
            /*    position: absolute;*/
            /*    left: 0;*/
            /*    right: 0;*/
            /*    text-align: center;}*/
        }






        .subPa {
            font-family: 'NowM', sans-serif;
            font-size: 14px;
            background: #FAF9F9;
            border-radius: 10px;
            padding: 20px;
            color: #000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* ظل خفيف */
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        .labelName{
            font-family: 'NowM', sans-serif;
            font-size: 14px;
            line-height: 20px;
        }



        input::placeholder {
            font-size: 12px;
            color: #e6e8e8; /* optional: lighter color */
            font-family: 'NowR', sans-serif;
        }

        input{
            border-radius: 8px !important;
            border: 1px solid #D0D5DD !important;

        }

        .check_input{
            width: 20px;
            height: 20px;
            border-radius: 1px;
            margin-right: 10px;
            color: #fff;
            border: 1px solid #8D8D8D !important;
            background: #D9D9D9;
        }

        .labelcheck{
            font-family: 'NowR', sans-serif;
            font-size: 12px;
        }

        .confirmCheck{
            font-family: 'NowR', sans-serif;
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .confirmCheck {
                font-family: 'NowR', sans-serif;
                font-size: 10px;
            }
        }

        .form-check-input:checked {
            background-color: #0d6efd; /* لون الخلفية */
            border-color: #0d6efd;     /* لون البوردر */
        }

        .form-check-input:checked[type="checkbox"] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='white' d='M13.485 1.929l-7.071 7.071-3.536-3.536L1.465 7.879l4.949 4.95 8.485-8.486z'/%3e%3c/svg%3e");
            background-size: 12px 12px;
            background-position: center;
            background-repeat: no-repeat;
        }

        .description{
            font-family:'NowR', sans-serif ;
            font-size: 16px;
            line-height: 30px
        }

        @media (max-width: 576px) {
            .description {
                font-size: 12px;
                line-height: 18px;
            }
        }
        /* مسافة أكبر على الشاشات الكبيرة */
        .custom-gap-tabs {
        gap: 60px; /* زوّد المسافة حسب ما تحب */
        }

        /* مسافة أصغر على الشاشات الصغيرة */
        @media (max-width: 768px) {
        .custom-gap-tabs {
            gap: 16px; /* أو 10px أو أي قيمة مناسبة للموبايل */
        }
    }
    
    
    .judge-form {
            direction: ltr !important;
            text-align: left !important;
        }

        .judge-form .form-label,
        .judge-form .labelName,
        .judge-form .labelcheck,
        .judge-form .confirmCheck {
            text-align: left !important;
            display: block;
        }

        .judge-form input[type="text"],
        .judge-form input[type="email"],
        .judge-form textarea {
            text-align: left !important;
        }

        /* Center checkbox and label vertically */
        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input.check_input {
            margin-top: 0 !important;
        }

        .form-check-label.labelcheck,
        .form-check-label.confirmCheck {
            margin-bottom: 0;
        }






    </style>
@endsection

@section('content')

    <section class="py-5">
        <div class="container">

            <!-- Tabs nav -->
            <div class="row justify-content-center">
                <div class="col-auto">
                    <ul class="nav nav-pills d-flex justify-content-center custom-gap-tabs custom-tabs mb-4" id="partnerTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="partner-tab" data-bs-toggle="pill" data-bs-target="#partner" type="button" role="tab" aria-controls="partner" aria-selected="true">
                                <span class="tab-text">{{__('partner.strategic_partner')}}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="developer-tab" data-bs-toggle="pill" data-bs-target="#developer" type="button" role="tab" aria-controls="developer" aria-selected="false">
                                {{__('partner.developer')}}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sponsor-tab" data-bs-toggle="pill" data-bs-target="#sponsor" type="button" role="tab" aria-controls="sponsor" aria-selected="false">
                                {{__('partner.sponsor')}}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Tabs content -->
            <div class="tab-content" id="partnerTabsContent">

                <!-- Partner Tab -->
                <div class="tab-pane fade show active" id="partner" role="tabpanel" aria-labelledby="partner-tab">
                @if($strategicPartners->count())
                        <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                @foreach($strategicPartners as $partner)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $partner->logo }}">
                                    </div>
                                @endforeach
                                {{-- تكرار العناصر لتأثير الانفينيتي --}}
                                @foreach($strategicPartners as $partner)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $partner->logo }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!--<p class="text-center text-muted">{{ __('partner.not_found') }}</p>-->
                        
                       <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                 @for ($i = 1; $i <= 18; $i++)
                                 <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/' . $i . '.webp') }}" alt="logo">
                                   </div>
                               @endfor
                            </div >
                          </div>
                    @endif

                    <div class="row justify-content-center mb-2 ">
                        <p class="description " >
                            {{__('partner.real_estate_partner_description')}}
                        </p>
                    </div>
                    <div class="row justify-content-center text-center mb-5 mt-2 g-4">
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.government_entities')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.investment_funds')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.financial_institutions')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.global_corporations')}}</div>
                        </div>
                    </div>

                    {{--submission--}}
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-8 col-md-10">

                            <!-- العنوان -->
                            <div class="text-start mb-4">
                                <h2 class="fw-bold" style="font-size:28px;font-family: 'NowM', sans-serif;">Partner Submission</h2>
                                <p class="text-muted" style="font-size:15px;font-family: 'NowR', sans-serif;color: #667085">Please enter your details.</p>
                            </div>

                           <!-- الفورم -->
                              <form method="POST" action="{{ route('partner.submit') }}" enctype="multipart/form-data" class="judge-form" dir="ltr">
                                @csrf

                                @if ($errors->any())
                                    <div class="mt-3">
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="mt-3">
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    </div>
                                @endif

                                <div class="row g-3">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter Full Name">
                                    </div>

                                    <!-- Entity Country -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Country</label>
                                        <input type="text" name="entity_country" value="{{ old('entity_country') }}" class="form-control" placeholder="Enter Your Country">
                                    </div>

                                    <!-- Contact Person -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Contact Person</label>
                                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control" placeholder="Enter Contact Person">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your Phone Number">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your Email Address">
                                    </div>

                                    <!-- Company -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Website</label>
                                        <input type="text" name="entity_website" value="{{ old('entity_website') }}" class="form-control" placeholder="Enter Company Website">
                                    </div>

                                    <!-- Expertise -->
                                    <div class="col-12">
                                        <label class="form-label labelName">Type Of Partnership</label>
                                        <div class="row">
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="ceo" name="type_of_partnership[]" value="Government Entities" {{ is_array(old('type_of_partnership')) && in_array('Government Entities', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="ceo">Government Entities</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="expert" name="type_of_partnership[]" value="Investment Funds" {{ is_array(old('type_of_partnership')) && in_array('Investment Funds', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="expert">Investment Funds</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="coach" name="type_of_partnership[]" value="Financial Institutions" {{ is_array(old('type_of_partnership')) && in_array('Financial Institutions', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="coach">Financial Institutions</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="designer" name="type_of_partnership[]" value="Global Corporations" {{ is_array(old('type_of_partnership')) && in_array('Global Corporations', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="designer">Global Corporations</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Other Expertise -->
                                    <div class="col-12">
                                        <label class="form-label  labelName">Other Sector</label>
                                        <input type="text" name="other_sector" value="{{ old('other_sector') }}" class="form-control" placeholder="Enter your Sector">
                                    </div>

                                    <!-- Big Names -->
                                    <div class="col-12 mt-4">
                                        <label class="form-label  labelName">Brief Description of Your Interest in Real Estate All-Stars:</label>
                                        <textarea name="interest_description" class="form-control" rows="2" placeholder="Enter your answer here">{{ old('interest_description') }}</textarea>
                                    </div>

                                    <!-- Upload -->
                                    <div class="col-md-8">
                                        <label class="form-label  labelName">Upload CV or Supporting Documents (optional):</label>
                                        <input class="form-control" type="file" name="document">
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="col-12">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input check_input" type="checkbox" id="confirm" name="agree" value="1" {{ old('agree') ? 'checked' : '' }}>
                                            <label class="form-check-label confirmCheck text-muted " for="confirm">
                                                I agree to be contacted regarding my submission and confirm that the information provided is accurate.
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12">
                                        <button type="submit" class="btn w-100 py-2 fw-semibold"
                                                style="background:black; color:white; border-radius:6px; font-size:16px;">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <!-- Developer Tab -->
                <div class="tab-pane fade" id="developer" role="tabpanel" aria-labelledby="developer-tab">
                     
                
                    
                    @if($developers->count())
                        <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                @foreach($developers as $developer)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->logo }}">
                                    </div>
                                @endforeach
                                {{-- تكرار العناصر لتأثير الانفينيتي --}}
                                @foreach($developers as $developer)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->logo }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!--<p class="text-center text-muted">{{ __('developer.not_found') }}</p>-->
                        
                       <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                 
                                <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="logo">
                                </div>
                                
                                <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div>
                                  
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div>
                                  
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt=''>
                                  </div>
                               
                            </div >
                          </div>
                    @endif
                    <div class="row justify-content-center mb-2 ">
                        <p class="description " >
                            {{__('partner.developer_opportunities')}}
                         </p>
                    </div>
                    {{-- <div class="row justify-content-center text-center mb-5 mt-2 g-4">
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.government_entities')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.investment_funds')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.financial_institutions')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.global_corporations')}}</div>
                        </div>
                    </div> --}}

                    {{--submission--}}
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-8 col-md-10">

                            <!-- العنوان -->
                            <div class="text-start mb-4">
                                <h2 class="fw-bold" style="font-size:28px;font-family: 'NowM', sans-serif;">Partner Submission</h2>
                                <p class="text-muted" style="font-size:15px;font-family: 'NowR', sans-serif;color: #667085">Please enter your details.</p>
                            </div>
<!-- الفورم -->
                            <form method="POST" action="{{ route('developer.form.submit') }}" enctype="multipart/form-data" dir="ltr">
                                @csrf

                                @if ($errors->any())
                                    <div class="mt-3">
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="mt-3">
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    </div>
                                @endif

                                <div class="row g-3">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter Full Name">
                                    </div>

                                    <!-- Entity Country -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Country</label>
                                        <input type="text" name="entity_country" value="{{ old('entity_country') }}" class="form-control" placeholder="Enter Your Country">
                                    </div>

                                    <!-- Contact Person -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Contact Person</label>
                                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control" placeholder="Enter Contact Person">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your Phone Number">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your Email Address">
                                    </div>

                                    <!-- Company -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Website</label>
                                        <input type="text" name="entity_website" value="{{ old('entity_website') }}" class="form-control" placeholder="Enter Company Website">
                                    </div>

                                    <!-- Expertise -->
                                    <div class="col-12">
                                        <label class="form-label labelName">Type Of Partnership</label>
                                        <div class="row">
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="ceo_dev" name="type_of_partnership[]" value="Government Entities" {{ is_array(old('type_of_partnership')) && in_array('Government Entities', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="ceo_dev">Government Entities</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="expert_dev" name="type_of_partnership[]" value="Investment Funds" {{ is_array(old('type_of_partnership')) && in_array('Investment Funds', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="expert_dev">Investment Funds</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="coach_dev" name="type_of_partnership[]" value="Financial Institutions" {{ is_array(old('type_of_partnership')) && in_array('Financial Institutions', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="coach_dev">Financial Institutions</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="designer_dev" name="type_of_partnership[]" value="Global Corporations" {{ is_array(old('type_of_partnership')) && in_array('Global Corporations', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="designer_dev">Global Corporations</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Other Expertise -->
                                    <div class="col-12">
                                        <label class="form-label  labelName">Other Sector</label>
                                        <input type="text" name="other_sector" value="{{ old('other_sector') }}" class="form-control" placeholder="Enter your Sector">
                                    </div>

                                    <!-- Big Names -->
                                    <div class="col-12 mt-4">
                                        <label class="form-label  labelName">Brief Description of Your Interest in Real Estate All-Stars:</label>
                                        <textarea name="interest_description" class="form-control" rows="2" placeholder="Enter your answer here">{{ old('interest_description') }}</textarea>
                                    </div>

                                    <!-- Upload -->
                                    <div class="col-md-8">
                                        <label class="form-label  labelName">Upload CV or Supporting Documents (optional):</label>
                                        <input class="form-control" type="file" name="document">
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="col-12">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input check_input" type="checkbox" id="confirm_dev" name="agree" value="1" {{ old('agree') ? 'checked' : '' }}>
                                            <label class="form-check-label confirmCheck text-muted " for="confirm_dev">
                                                I agree to be contacted regarding my submission and confirm that the information provided is accurate.
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12">
                                        <button type="submit" class="btn w-100 py-2 fw-semibold"
                                                style="background:black; color:white; border-radius:6px; font-size:16px;">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Sponsor Tab -->
                <div class="tab-pane fade" id="sponsor" role="tabpanel" aria-labelledby="sponsor-tab">
                     
                    
                     @if($sponsors->count())
                        <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                @foreach($sponsors as $sponsor)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $sponsor->logo }}">
                                    </div>
                                @endforeach
                                {{-- تكرار العناصر لتأثير الانفينيتي --}}
                                @foreach($sponsors as $sponsor)
                                    <div class="logo-card">
                                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $sponsor->logo }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!--<p class="text-center text-muted">{{ __('sponsor.not_found') }}</p>-->
                        
                        <div class="logo-carousel" data-carousel>
                            <div class="logo-track">
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div> 
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div>
                                  
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div>
                                  
                                  <div class="logo-card">
                                   <img src="{{ asset('public/images/partner/1221.webp') }}" alt="">
                                  </div>
                            </div >
                          </div>
                    @endif
                    <div class="row justify-content-center mb-2 ">
                        <p class="description " >
                            {{__('partner.sponsor_benefits')}}
                           </p>
                    </div>
                   {{--  <div class="row justify-content-center text-center mb-5 mt-2 g-4">
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.government_entities')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.investment_funds')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.financial_institutions')}}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="subPa">{{__('partner.global_corporations')}}</div>
                        </div>
                    </div> --}}

{{--submission--}}
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-8 col-md-10">

                            <!-- العنوان -->
                            <div class="text-start mb-4">
                                <h2 class="fw-bold" style="font-size:28px;font-family: 'NowM', sans-serif;">Partner Submission</h2>
                                <p class="text-muted" style="font-size:15px;font-family: 'NowR', sans-serif;color: #667085">Please enter your details.</p>
                            </div>

                            <!-- الفورم -->
                            <form method="POST" action="{{ route('sponsor.form.submit') }}" enctype="multipart/form-data" class="judge-form" dir="ltr">
                                @csrf

                                @if ($errors->any())
                                    <div class="mt-3">
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="mt-3">
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    </div>
                                @endif

                                <div class="row g-3">
                                    <!-- Full Name -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter Full Name">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Country</label>
                                        <input type="text" name="entity_country" value="{{ old('entity_country') }}" class="form-control" placeholder="Enter Your Country">
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Contact Person</label>
                                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control" placeholder="Enter Contact Person">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your Phone Number">
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your Email Address">
                                    </div>

                                    <!-- Company -->
                                    <div class="col-md-6">
                                        <label class="form-label  labelName">Entity Website</label>
                                        <input type="text" name="entity_website" value="{{ old('entity_website') }}" class="form-control" placeholder="Enter Company Website">
                                    </div>

                                    <!-- Expertise -->
                                    <div class="col-12">
                                        <label class="form-label labelName">Type Of Partnership</label>
                                        <div class="row">
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="ceo_sponsor" name="type_of_partnership[]" value="Government Entities" {{ is_array(old('type_of_partnership')) && in_array('Government Entities', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="ceo_sponsor">Government Entities</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="expert_sponsor" name="type_of_partnership[]" value="Investment Funds" {{ is_array(old('type_of_partnership')) && in_array('Investment Funds', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="expert_sponsor">Investment Funds</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="coach_sponsor" name="type_of_partnership[]" value="Financial Institutions" {{ is_array(old('type_of_partnership')) && in_array('Financial Institutions', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="coach_sponsor">Financial Institutions</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input check_input" type="checkbox" id="designer_sponsor" name="type_of_partnership[]" value="Global Corporations" {{ is_array(old('type_of_partnership')) && in_array('Global Corporations', old('type_of_partnership')) ? 'checked' : '' }}>
                                                    <label class="form-check-label labelcheck" for="designer_sponsor">Global Corporations</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Other Expertise -->
                                    <div class="col-12">
                                        <label class="form-label  labelName">Other Sector</label>
                                        <input type="text" name="other_sector" value="{{ old('other_sector') }}" class="form-control" placeholder="Enter your Sector">
                                    </div>

                                    <!-- Big Names -->
                                    <div class="col-12 mt-4">
                                        <label class="form-label  labelName">Brief Description of Your Interest in Real Estate All-Stars:</label>
                                        <textarea name="interest_description" class="form-control" rows="2" placeholder="Enter your answer here">{{ old('interest_description') }}</textarea>
                                    </div>

                                    <!-- Upload -->
                                    <div class="col-md-8">
                                        <label class="form-label  labelName">Upload CV or Supporting Documents (optional):</label>
                                        <input class="form-control" type="file" name="document">
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="col-12">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input check_input" type="checkbox" id="confirm_sponsor" name="agree" value="1" {{ old('agree') ? 'checked' : '' }}>
                                            <label class="form-check-label confirmCheck text-muted " for="confirm_sponsor">
                                                I agree to be contacted regarding my submission and confirm that the information provided is accurate.
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12">
                                        <button type="submit" class="btn w-100 py-2 fw-semibold"
                                                style="background:black; color:white; border-radius:6px; font-size:16px;">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>






@endsection

@push('scripts')
<!-- <script>
    (function(){
        const intervalMs = 3000;
        document.querySelectorAll('[data-carousel]').forEach(initCarousel);

        function initCarousel(carousel) {
            const track = carousel.querySelector('.logo-track');
            if (!track) return;

            let logoWidth = track.querySelector('.logo-card')?.getBoundingClientRect().width || 120;
            let timer = setInterval(() => moveNext(), intervalMs);
            let animating = false;

            const resetTransition = () => {
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
            };

            const moveNext = () => {
                if (animating) return;
                animating = true;
                track.style.transition = 'transform 0.6s linear';
                track.style.transform = `translateX(-${logoWidth}px)`;
                setTimeout(() => {
                    track.appendChild(track.firstElementChild);
                    resetTransition();
                    animating = false;
                }, 600);
            };

            const movePrev = () => {
                if (animating) return;
                animating = true;
                track.style.transition = 'none';
                track.insertBefore(track.lastElementChild, track.firstElementChild);
                track.style.transform = `translateX(-${logoWidth}px)`;
                requestAnimationFrame(() => {
                    track.style.transition = 'transform 0.6s linear';
                    track.style.transform = 'translateX(0)';
                    setTimeout(() => {
                        resetTransition();
                        animating = false;
                    }, 600);
                });
            };

            carousel.addEventListener('mouseenter', () => clearInterval(timer));
            carousel.addEventListener('mouseleave', () => restart());

            carousel.addEventListener('wheel', (e) => {
                e.preventDefault();
                if (e.deltaY > 0) { moveNext(); restart(); }
                else { movePrev(); restart(); }
            }, { passive: false });

            window.addEventListener('resize', () => {
                logoWidth = track.querySelector('.logo-card')?.getBoundingClientRect().width || 120;
            });

            function restart() {
                clearInterval(timer);
                timer = setInterval(() => moveNext(), intervalMs);
            }
        }
    })();
</script>
 -->

 <script>
    document.querySelectorAll('[data-carousel]').forEach(carousel => {
        const track = carousel.querySelector('.logo-track');

        // إيقاف الحركة عند المرور بالماوس
        carousel.addEventListener("mouseenter", () => {
            track.style.animationPlayState = "paused";
        });
        carousel.addEventListener("mouseleave", () => {
            track.style.animationPlayState = "running";
        });
    });
</script>
@endpush
