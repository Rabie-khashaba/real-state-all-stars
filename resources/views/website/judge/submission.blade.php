@extends('website.layouts.master')

@section('styles')

    <style>



        .hero {
            position: relative;
            height: 327px; /* ⬅️ نص الشاشة */
            overflow: hidden;
            background: url("{{ asset('public/images/judge/Judge Submission Form.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
            line-height: 1.5;
        }

        .headline-start {
            display: block;
            text-align: center; /* second part from start */
            font-family: 'NowR', sans-serif;
            margin-left : 50px;
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
            font-family: 'NowM', sans-serif;
            line-height: 27px;
            font-size: 37px;
        }

        .spanText{
            font-family: 'NowR', sans-serif;
            color: #F8DA58
        }
        .description-text{
            font-family: 'NowR', sans-serif;
            font-size: 35px;
            margin-top: 15px;
        }
        .headline-start{
            padding-left: 25px;
        }


        @media (max-width: 576px) {

            .main-heading{
                font-size: 24px;
                line-height: 30px;
                padding-top: 30px;
            }
            .description-text{
                font-size: 18px;
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
            background: #D9D9D9 !important;
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


        @media (max-width: 576px) {
    .headline-start {
        font-size: 18px;
        line-height: 1.4;
        margin-left: 0;   /* يشيل الإزاحة */
        padding-left: 0;
    }
}


.check_input{
            width: 20px;
            height: 20px;
            border-radius: 1px;
            margin-right: 10px;
            color: #fff;
            border: 1px solid #8D8D8D;
            background: #D9D9D9;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            vertical-align: middle;
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

        .form-check-input[type="checkbox"]:checked {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='white' d='M13.485 1.929l-7.071 7.071-3.536-3.536L1.465 7.879l4.949 4.95 8.485-8.486z'/%3e%3c/svg%3e") !important;
            background-size: 12px 12px !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }


        /* Force LTR layout for the judge submission form regardless of site language */
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

        .expertise-row .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .expertise-row .form-check-label {
            margin-bottom: 0;
        }




    </style>
@endsection

@section('content')
    {{--section 1--}}
    <section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->
            <div class="row d-flex flex-column justify-content-start text-white text-start pt-5 text-wrapper">
                <p class="col-12 col-md-12 mt-4 mb-3 main-heading">
                    <span class="headline-center">{{ __('judge.on_set_ready') }}</span><br>
                    <!--<span class="headline-start">{!! __('judge.looking_for_pioneers', ['pioneers' => '<span class="spanText" style="color: #F8DA58;">'.__('judge.pioneers').'</span>']) !!}</span>-->
                </p>
                <!--<p class="col-12 col-md-12 mb-3 headline-center description-text">-->
                <!--    {{ __('judge.we_know_you') }}-->
                <!--</p>-->
            </div>
        </div>


    </section>

    {{--section 2--}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">

                    <!-- العنوان -->
                    <div class="text-start mb-4">
                        <h2 class="fw-bold" style="font-size:28px;font-family: 'NowM', sans-serif;">Judge Submission</h2>
                        <p class="text-muted" style="font-size:15px;font-family: 'NowR', sans-serif;color: #667085">Please enter your details.</p>
                    </div>


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

                    <!-- الفورم -->
                    <form method="POST" action="{{ route('judge.submit') }}" enctype="multipart/form-data"  class="judge-form" dir="rtl">
                        @csrf

                        <div class="row g-3 text-start">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label class="form-label  labelName">Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Enter Full Name" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label  labelName">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your Email Address">
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label  labelName">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your Phone Number">
                            </div>

                            <!-- Role -->
                            {{-- <div class="col-md-6">
                                <label class="form-label  labelName">Professional Title/Role</label>
                                <input type="text" name="professional_title" value="{{ old('professional_title') }}" class="form-control" placeholder="Enter your Professional Title/Role">
                            </div> --}}

                            <!-- Company -->
                            {{-- <div class="col-12">
                                <label class="form-label  labelName">Company/Organization (if applicable):</label>
                                <input type="text" name="company" value="{{ old('company') }}" class="form-control" placeholder="Enter Company/Organization">
                            </div> --}}

                            <!-- Expertise -->
                            {{-- <div class="col-12">
                                <label class="form-label labelName">Areas of Expertise</label>
                                <div class="row expertise-row">
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input check_input" type="checkbox" id="ceo" name="areas_of_expertise[]" value="Real Estate CEO" {{ is_array(old('areas_of_expertise')) && in_array('Real Estate CEO', old('areas_of_expertise')) ? 'checked' : '' }}>
                                            <label class="form-check-label labelcheck" for="ceo">Real Estate CEO</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input check_input" type="checkbox" id="expert" name="areas_of_expertise[]" value="Real Estate Expert" {{ is_array(old('areas_of_expertise')) && in_array('Real Estate Expert', old('areas_of_expertise')) ? 'checked' : '' }}>
                                            <label class="form-check-label labelcheck" for="expert">Real Estate Expert</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input check_input" type="checkbox" id="coach" name="areas_of_expertise[]" value="Sales Coach" {{ is_array(old('areas_of_expertise')) && in_array('Sales Coach', old('areas_of_expertise')) ? 'checked' : '' }}>
                                            <label class="form-check-label labelcheck" for="coach">Sales Coach</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input check_input" type="checkbox" id="designer" name="areas_of_expertise[]" value="Interior Designer" {{ is_array(old('areas_of_expertise')) && in_array('Interior Designer', old('areas_of_expertise')) ? 'checked' : '' }}>
                                            <label class="form-check-label labelcheck" for="designer">Interior Designer</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                            <!-- Other Expertise -->
                            {{-- <div class="col-12">
                                <input type="text" name="other_expertise" value="{{ old('other_expertise') }}" class="form-control" placeholder="Enter Your Area of Expertise (if not listed)">
                            </div> --}}

                            <!-- Big Names -->
                            {{-- <div class="col-12 mt-4">
                                <label class="form-label  labelName">Brief Description of your Experience in Real Estate or Related Fields,</label>
                                <textarea name="experience_description" class="form-control" rows="2" placeholder="Enter your answer here">{{ old('experience_description') }}</textarea>
                            </div> --}}

                            <!-- Upload -->
                            {{-- <div class="col-md-8">
                                <label class="form-label  labelName">Upload CV or Supporting Documents (optional):</label>
                                <input class="form-control" type="file" name="document">
                            </div> --}}

                            <!-- Checkbox -->
                            {{-- <div class="col-12">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input check_input" type="checkbox" id="confirm">
                                    <label class="form-check-label confirmCheck text-muted " for="confirm">
                                        I confirm that the information provided is accurate and agree to be contacted regarding this submission
                                    </label>
                                </div>
                            </div> --}}


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
    </section>






@endsection
