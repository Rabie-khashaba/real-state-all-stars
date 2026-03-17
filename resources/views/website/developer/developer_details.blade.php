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

        .responsive-img{
            width: 100%;
            height: 400px;
            display: block;
            object-fit: cover;
            object-position: center;
            border-radius:12px;

        }

        @media (max-width: 767px) {
            .responsive-img {
                width: 100%;
                height: auto;
                max-height: none;
                object-fit: contain;
                border-radius: 12px;
            }
        }

        /* ديسكتوب: الصورة بحجمها الطبيعي */
        @media (min-width: 768px) {
            .responsive-img {
                max-width: 100%;
                height: 400px;
            }
        }



        .img-section{

            /*padding-left:px;*/
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

            .img-section{
                padding-left:0px;
            }

        }

        @media (min-width: 992px) { /* lg screens */
            .custom-col {
                flex: 0 0 20%;   /* 100% ÷ 5 كروت */
                max-width: 20%;
            }
        }

        .carditem .card-img-top {
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
        }

        @media (max-width: 767px) {
            .carditem .card-img-top {
                height: 180px;
            }
        }




    </style>
@endsection

@section('content')

    {{-- section 1 --}}
    <section class="py-3 bg-white img-section">
        <div class="container">

            <!-- الجزء الخاص بالصورة -->
            <div class="row">
                <div class="col-12 col-md-12 justify-content-center ">
                    <img  src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->banner }}"
                         alt="..."
                         class="responsive-img">
                </div>
            </div>

            <!-- الجزء الخاص بالتفاصيل -->
            <div class="mt-5">

                <!-- الصورة + النصوص جنب بعض -->
                <div class="d-flex align-items-center">
                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->logo }}"
                         alt="..."
                         style="width:48px; height:48px; object-fit:cover; margin-right:10px;">

                    <div>
                        <h2 style="font-family: 'NowB', sans-serif; font-size: 24px;line-height: 28px" class="mb-1">{{ app()->getLocale() === 'ar' ? $developer->name_ar : $developer->name_en }}</h2>
                       {{-- <span style="width: 20px;height: 20px"><img src="{{asset('public/images/developer/location.png')}}"></span> <span style="font-family: 'NowR', sans-serif; font-size: 16px">Ras Elkema</span>  --}}
                    </div>
                </div>

                <!-- الباراجراف تحت -->
                <p style="font-family: 'NowR', sans-serif; font-size: 16px ; line-height: 22px; width: 85%" class="mt-3">
                    {{ app()->getLocale() === 'ar' ? $developer->description_ar : $developer->description_en }}
                </p>

               

            </div>

        </div>
    </section>




    <section class="py-5 bg-white">
        <div class="container-fluid">

           <!-- Filters -->
            <form method="GET">
                <div class="row mb-4 justify-content-center">
                    <!-- خانة المشاريع داخل المنافسة -->
                    <div class="col-md-3 col-4 mb-2">
                        <select name="competition" class="form-select forms">
                            <option value="" disabled selected>{{ __('developer.select_option') }}</option>
                            <option value="in" {{ request('competition') == 'in' ? 'selected' : '' }}>
                                {{ __('developer.in_competition') }}
                            </option>
                        </select>
                    </div>
            
                    <!-- خانة المشاريع خارج المنافسة -->
                    <div class="col-md-3 col-4 mb-2">
                        <select name="competition" class="form-select forms">
                            <option value="" disabled selected>{{ __('developer.select_option') }}</option>
                            <option value="out" {{ request('competition') == 'out' ? 'selected' : '' }}>
                                {{ __('developer.out_competition') }}
                            </option>
                        </select>
                    </div>
            
                    <!-- زر الفلترة -->
                    <div class="col-md-2 col-4 mb-2">
                        <button type="submit" class="btn btn-dark formf w-100">{{ __('developer.filter') }}</button>
                    </div>
                </div>
            </form>


            
            <div class="row px-5 g-4 justify-content-start">
                <!-- Card -->
                
            @if($developer->projects->isNotEmpty())
                @foreach($projects as $project)                
                <div class="col-12 col-md-4 custom-col">
                    <a href="{{route('project.details' , $project->id )}}" class="text-decoration-none text-dark">
                    <div class="card border-0 carditem h-100">
                        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $project->main_photo }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-start">
                                <!-- اللوجو في دايرة -->
                                <div style="flex: 0 0 auto; width:50px; height:50px;
                        border-radius:50%; overflow:hidden;
                        border:2px solid #E2E8F0; background:#fff;
                        display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $developer->logo }}"
                                         alt="Logo"
                                         style="width:100%; height:100%; object-fit:contain; object-position:center;">
                                </div>

                                <!-- النصوص -->
                                <div class="ms-3">
                                   <h2 style="font-family: 'NowB', sans-serif; font-size: 16px; margin-bottom: 0px;">
                                        {{ app()->getLocale() === 'ar' ? $project->name_ar : $project->name_en }}
                                    </h2>
                                    <p style="font-family: 'NowR', sans-serif; font-size: 10px; margin:0; color:#64748B;">
                                        {{ app()->getLocale() === 'ar' ? $project->short_description_ar : $project->short_description_en }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                
                @endforeach
            @else
                <p class="text-muted">No projects found for this developer.</p>
            @endif
                
                
              


            </div>





        </div>
    </section>










@endsection
