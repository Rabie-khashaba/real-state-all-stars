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

    @media (max-width: 576px){
        .country-text {
            font-size: 9px;
            line-height: 14px;
        }
    }

    .section-title{
        font-family: 'NowB', sans-serif;
        font-size: 25px;
        line-height: 30px;
        margin-top:30px ;

    }
    .section-subtitle{
        font-family: 'NowM', sans-serif;
        font-size: 18px;
        line-height: 30px;
    }

    .section-text{
        font-family: 'NowR', sans-serif;
        font-size: 14px;
        line-height: 20px;
    }


    /* 📱 تعديل الموبايل */
    @media (max-width: 768px) {
        .section-title {
            font-size: 20px;
            line-height: 22px;
        }
        .section-subtitle {
            font-size: 14px;
            line-height: 20px;
        }
        .section-text {
            font-size: 12px;
            line-height: 18px;
        }

    }

    @media (min-width: 768px) {
        .image-wrapper {
            position: sticky;
            top: 100px; /* المسافة من فوق، ممكن تعدل حسب التصميم */
            align-self: flex-start; /* عشان تلتصق من فوق العمود */
        }
    }

    /* للجوال نتركها تتحرك طبيعي */
    @media (max-width: 768px) {
        .image-wrapper {
            position: relative;
            top: auto;
            margin: 0 auto;
        }
    }




    .section3-title{
        font-family: 'NowB', sans-serif;
        font-size: 25px;
        line-height: 24px;
        text-transform: uppercase;

    }
    .section3-subtitle{
        font-family: 'NowB', sans-serif;
        font-size: 17px;
        line-height: 25px;
    }

    .section3-text{
        font-family: 'NowR', sans-serif;
        font-weight: 400;
        font-size: 15px;
        line-height: 25px;
    }

    /* 📱 تعديل الموبايل */
    @media (max-width: 768px) {
        .section3-title {
            font-size: 16px;
            line-height: 22px;
        }
        .section3-subtitle {
            font-size: 15px;
            line-height: 20px;
        }
        .section3-text {
            font-size: 12px;
            line-height: 18px;
        }

    }
    /* remove unwanted horizontal overflow on mobile */
    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .logo-img {
        width: 215px;
        height: 215px;
        object-fit: contain; /* أو استخدم cover حسب ما يناسبك */
        }



</style>
@endsection

@section('content')

{{-- section 1 --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">

                <!-- العمود الأول: الصورة -->
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <img style="width: 400px; height: 228px" src="{{asset('public/images/country/ksa.png')}}"
                         alt="Example Image"
                         class="img-fluid rounded shadow">
                </div>

                <!-- العمود الثاني: النص -->
                <div class="col-md-7">
                    <h2 style="font-family: 'NowB', sans-serif; font-size: 34px;" class="fw-bold mb-3">{{ __('country.saudi_real_estate_transformation') }}</h2>
                    <p  class="country-text" style="font-family: 'NowR', sans-serif;font-size: 15px; line-height: 22px">
                       {!! __('country.saudi_real_estate_transformation_details') !!}
                    </p>

                </div>

            </div>
        </div>
    </section>

{{-- section 2 --}}
<section class="py-2 mb-2 bg-white">
    <div class="container d-flex justify-content-center">
        <div class="row align-items-start w-100">
            <!-- عمود النصوص -->
            <div class="col-md-6 col-12 order-2 order-md-1 d-flex flex-column justify-content-center">

                <h2 class="mb-4 section-title">
                    {{ __('country.saudi_real_estate_transformation_title') }}
                </h2>
                <!-- عنصر 1 -->
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 section-subtitle">
                            {{ __('country.market_overview_title') }} 
                        </p>
                        <button style="color: #000" class="btn btn-link p-0 fs-4 text-decoration-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="false"
                                aria-controls="collapseOne">
                            +
                        </button>
                    </div>
                    <div class="collapse mt-2" id="collapseOne">
                        <p class="mb-0 section-text">
                          <p class="mb-0 section-text">
                        {!! __('country.market_overview_details') !!}   <br>             
                       

                    </p>



                    </p>
                    </div>
                </div>

                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 section-subtitle" >
                           {{__('country.sa_market_phase2')}}
                        </p>
                        <button style="color: #000" class="btn btn-link p-0 fs-4 text-decoration-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo">
                            +
                        </button>
                    </div>
                    <div class="collapse mt-2" id="collapseTwo">
                        <p class="mb-0 section-text" >
                            {!! __('country.sa_market_phase2_details') !!}
                        </p>
                    </div>
                </div>

                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 section-subtitle" >
                            {{__('country.sa_market_phase3_title')}}
                        </p>
                        <button style="color: #000" class="btn btn-link p-0 fs-4 text-decoration-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree">
                            +
                        </button>
                    </div>
                    <div class="collapse mt-2" id="collapseThree">
                        <p class="mb-0 section-text" >
                           {!! __('country.sa_market_phase3') !!}
                        </p>
                    </div>
                </div>

                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 section-subtitle">
                            {{__('country.sa_market_title4')}}
                        </p>
                        <button style="color: #000" class="btn btn-link p-0 fs-4 text-decoration-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseFour"
                                aria-expanded="false"
                                aria-controls="collapseFour">
                            +
                        </button>
                    </div>
                    <div class="collapse mt-2" id="collapseFour">
                        <p class="mb-0 section-text">
                          {!! __('country.sa_market_innovations_details') !!}
                        </p>
                    </div>
                </div>

            </div>

            <!-- عمود الصورة -->
            <div class="col-md-6 col-12 order-1 order-md-2 mb-4 mb-md-0 d-flex justify-content-center justify-content-md-center">
                <div class="image-wrapper">
                    <img src="{{ asset('public/images/country/ksaTower.png') }}"
                         alt="Example Image"
                         class="img-fluid rounded shadow">
                </div>
            </div>

        </div>
    </div>
</section>

{{--section 3 --}}
<section class="py-5 bg-white">
    <div class="container">

        <h2 class="mb-4 section3-title text-center text-md-center">
            {{__('country.sa_real_estate_regulators_title')}}
        </h2>
        <div class="row">

            <!-- First Part: Headings and Paragraphs -->
            <div class="col-md-12 mb-2">
                {!!__('country.sa_real_estate_regulators_details')!!}
            </div>

            <!-- Second Part: Images -->
            <div class="col-md-12">
                <div class="row text-center g-4 justify-content-center">
                    <div class="col-6 col-md-2">
                        <img style="width: 170px;" src="{{asset('public/images/country/logo_ksa/1.png')}}" alt="Image 1" class="img-fluid logo-img">
                    </div>
                    <div class="col-6 col-md-2">
                        <img src="{{asset('public/images/country/logo_ksa/02.png')}}" alt="Image 2" class="img-fluid logo-img">
                    </div>
                    <div class="col-6 col-md-2">
                        <img src="{{asset('public/images/country/logo_ksa/03.png')}}" alt="Image 3" class="img-fluid logo-img">
                    </div>
                    <div class="col-6 col-md-2">
                        <img src="{{asset('public/images/country/logo_ksa/04.png')}}" alt="Image 4" class="img-fluid logo-img">
                    </div>
                     <div class="col-6 col-md-2">
                        <img src="{{asset('public/images/country/logo_ksa/5.png')}}" alt="Image 4" class="img-fluid logo-img">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>







@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapses = document.querySelectorAll('.collapse');

        collapses.forEach(collapse => {
            collapse.addEventListener('shown.bs.collapse', function () {
                // نفذ الـ scroll بس لو الشاشة أصغر من 768px (موبايل)
                if (window.innerWidth < 768) {
                    // نزّل شوية قبل العنصر عشان زر الـ + يفضل ظاهر
                    const offset = 20; // تقدر تغير القيمة حسب ما تحب
                    const elementPosition = collapse.getBoundingClientRect().top + window.pageYOffset;
                    window.scrollTo({
                        top: elementPosition - offset,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

        toggles.forEach(btn => {
            const targetId = btn.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);

            // لما الـ collapse يفتح
            target.addEventListener('shown.bs.collapse', function () {
                btn.textContent = '-';
            });

            // لما الـ collapse يقفل
            target.addEventListener('hidden.bs.collapse', function () {
                btn.textContent = '+';
            });
        });
    });
</script> -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

    toggles.forEach(btn => {
        const targetId = btn.getAttribute('data-bs-target');

        // ❌ استثناء زرار النافبار
        if (targetId === '#navbarNav') return;

        const target = document.querySelector(targetId);

        // 🟢 فحص مبدئي
        if (target.classList.contains('show')) {
            btn.textContent = '-';
        } else {
            btn.textContent = '+';
        }

        // 🔄 تحديث عند الفتح
        target.addEventListener('shown.bs.collapse', function () {
            btn.textContent = '-';
        });

        // 🔄 تحديث عند الإغلاق
        target.addEventListener('hidden.bs.collapse', function () {
            btn.textContent = '+';
        });
    });
});
</script>

