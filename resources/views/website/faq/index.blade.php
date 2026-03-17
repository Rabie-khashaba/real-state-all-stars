@extends('website.layouts.master2')

@section('styles')
    <style>

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Bold.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowL';
            src: url("{{ asset('storage/font/Now-Light.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowM';
            src: url("{{ asset('storage/font/Now-Medium.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowTh';
            src: url("{{ asset('storage/font/Now-Thin.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }
        .nav-tabs {
            padding-left: 0;     /* إزالة البادئة الداخلية */
            margin-left: 0;
            border-bottom: 2px solid #000; /* سمك ولون الخط */

        }

        .nav-tabs .nav-link {
        padding-left: 0.5rem;  /* قلل البادئة الداخلية حسب الرغبة */
        padding-right: 0.5rem;
        text-align: left;      /* اجعل النص يبدأ من اليسار */
        border: none;
        background: none;
        color: #667085;
         font-family: 'NowR', sans-serif;
        font-size: 16px;
        }

         @media (max-width: 767.98px) {
         .nav-tabs .nav-link{
            font-size: 12px;
        }
        }


       .nav-tabs .nav-link.active {
        color: #000 !important; /* لون مميز عند التحديد */
        background-color: #f8f9fa !important;
        font-family: 'NowR', sans-serif;
        font-size: 16px;
        }
        .subtitle{
            font-family: 'NowM', sans-serif;
            font-size: 18px;
        }

         @media (max-width: 767.98px) {
         .subtitle{
            font-size: 15px;
        }
        }

        .para{
            font-family: 'NowM', sans-serif;
            font-size: 16px;
            line-height: 24px;
            color: #667085;
             margin-left: 0;    /* إزالة أي هامش أيسر */
            padding-left: 0;   /* إزالة أي حشوة يسار */
            text-align: left;  /* محاذاة اليسار */
        }

        .toggle-btn {
            color: #000; /* غيّر اللون هنا لأي لون تحبه */
        }



        /* اختياري: تعديل المسافة حسب حجم الشاشة */
        @media (max-width: 767.98px) {
        .collapse {
            padding-left: 0;
        }
        }

        .content{
            max-width: 800px;
        }
        .title{
            font-family: 'NowM', sans-serif;
            font-size: 35px;
        }
        .para2{
            font-family: 'NowM', sans-serif;
            font-size: 20px;
            line-height: 30px;
            color: #667085;
        }

</style>



@endsection

@section('content')

<section class="container py-5">
    <div class="content justify-content-star">
        <h2 class="title">Frequently Asked Questions</h2>
        <p class="para2">Got questions? We’ve got answers. Explore the most common queries about What is Real Estate All-Stars?</p>
    </div>
</section>


<section style="margin-bottom: 200px;" class="py-5 bg-light">
  <div class="container">

    <!-- Tabs (بداية التبويبات) -->
    <ul class="nav nav-tabs custom-tabs justify-content-start mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1"
            role="tab" aria-controls="tab1" aria-selected="true">General Questions</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2"
            role="tab" aria-controls="tab2" aria-selected="false">Registration</a>
        </li>
         <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3"
            role="tab" aria-controls="tab3" aria-selected="false">Competition</a>
        </li>
    </ul>

    <!-- المحتوى لكل Tab -->
    <div class="tab-content" id="myTabContent">
      <!-- Tab 1 -->
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
        <div class="border-bottom py-3">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 subtitle">What is Real Estate All-Stars? </p>
            <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOverview1"
                    aria-expanded="false"
                    aria-controls="collapseOverview2">></button>
          </div>
          <div class="collapse mt-2" id="collapseOverview1">
            <p class="para">Real Estate All-Stars is an innovative real estate competition in Egypt designed to discover, celebrate, and develop the best real estate brokers. It combines the excitement of reality TV with the professionalism of the real estate industry,
                providing a unique platform for brokers to showcase their talents, enhance their skills, and achieve career growth.</p>
          </div>
        </div>

        <div class="border-bottom py-3">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 subtitle">Who can participate in Real Estate All-Stars? </p>
            <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOverview2"
                    aria-expanded="false"
                    aria-controls="collapseOverview2">></button>
          </div>
          <div class="collapse mt-2" id="collapseOverview2">
            <p class="para"></p>
          </div>
        </div>

        <div class="border-bottom py-3">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 subtitle">How do I register for the competition? </p>
            <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOverview3"
                    aria-expanded="false"
                    aria-controls="collapseOverview3">></button>
          </div>
          <div class="collapse mt-2" id="collapseOverview3">
            <p class="para"></p>
          </div>
        </div>
      </div>

      <!-- Tab 2 -->
      <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        <div class="border-bottom py-3">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 subtitle">Registration</p>
            <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseInterior"
                    aria-expanded="false"
                    aria-controls="collapseInterior">+</button>
          </div>
          <div class="collapse mt-2" id="collapseInterior">

          </div>
        </div>
      </div>

      <!-- Tab 3 -->
      <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
        <div class="border-bottom py-3">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 subtitle">Competition</p>
            <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseInterior"
                    aria-expanded="false"
                    aria-controls="collapseInterior">+</button>
          </div>
          <div class="collapse mt-2" id="collapseInterior">

          </div>
        </div>
      </div>

    </div>

  </div>
</section>




@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-btn');
    toggles.forEach(btn => {
      const target = document.querySelector(btn.getAttribute('data-bs-target'));
      target.addEventListener('shown.bs.collapse', () => btn.textContent = '-');
      target.addEventListener('hidden.bs.collapse', () => btn.textContent = '>');
    });
  });
</script>

