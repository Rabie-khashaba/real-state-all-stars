@extends('website.layouts.master')

@section('styles')

<style>



    .hero {
        position: relative;
        height: 460px; /* ⬅️ نص الشاشة */
        overflow: hidden;
        background: url("{{ asset('public/images/profile/My Profile.png') }}") center center/cover no-repeat; /* ⬅️ الخلفية صورة */
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
    }

    .headline-start {
        display: block;
        text-align: left; /* second part from start */
        font-family: 'NowR', sans-serif;
    }




    /* hhh */


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


        .profile-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .activation-box {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
        }
        .profile-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        }


        .right , .middle , .left {
            margin-top: -10px;
            z-index: 1;
            position: relative;
            border-radius: 12px;
        }

        .personal-info {
            background-color: #FAF9F9;
            padding: 15px;
            border-radius: 5px;
        }

        .info-table {
            width: 95%;
            border-collapse: collapse; /* إزالة المسافات بين الخلايا */
        }

        .info-table td {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }



    /* التابات */
    .nav-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        border-bottom: 2px solid #ccc; /* الخط الأساسي تحت التابات */
        position: relative;
    }

    /* الزر غير المفعل */
    .nav-tabs .nav-link {
        color: #9F9898;
        border: none;
        background: transparent;
    }

    /* الزر المفعل */
    .nav-tabs .nav-link.active {
        color: #000;
        border: none;
        border-bottom: 2px solid #000; /* خط أسود داكن للتاب النشط */
        background-color: transparent;
        position: relative;
        z-index: 2; /* عشان يكون فوق الخط الرمادي */
        margin-bottom: -17px;
    }

    /* حجم الخط في الموبايل */
    @media (max-width: 768px) {
    .nav-tabs .nav-link {
        font-size: 14px;
    }
    }

    .card {
        border-radius: 10px;
        background-color: #FAF9F9;
    }

    .btn-dark {
        border-radius: 6px;
        font-weight: 500;
    }

    .title{
        font-family: 'NowB', sans-serif;
        font-size: 22px;
    }
    .subtitle{
        font-family: 'NowM', sans-serif;
        font-size: 14px;
        line-height: 18px;
    }

    @media (max-width: 768px) {
        .title{
            font-size: 18px;
        }
        .subtitle{
            font-size: 12px;
            line-height: 16px;
        }
    }
    .cardVote , .cardNum , .cardTitle{
        font-family: 'NowM', sans-serif;
        font-size: 16px;
    }
    .btnText{
        font-family: 'NowM', sans-serif;
        font-size: 12px;
    }


    /* الخلفية السوداء الشفافة */
    .overlay {
    display: none; /* مخفية افتراضيًا */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000000e2;
    z-index: 9999;
    justify-content: center;
    align-items: center;
    }

    /* البوكس الأبيض */
    .popup {
    background: transparent;
    border-radius: 15px;
    max-width: 100%;
    }

    /* أنيميشن ناعم للظهور */
    .overlay.show {
    display: flex;
    animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
    }

    .discount-title{
        font-family: 'NowM', sans-serif;
        font-size: 14px;
        text-align: start;
        color: white;
    }
    .discount-subtitle{
        font-family: 'NowR', sans-serif;
        font-size: 10px;
        color:#fff;
    }





</style>
@endsection

@section('content')
    {{--section 1--}}
<section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->

        </div>
</section>



<div class="container mb-5">
  <div class="row g-4">

    <div class="col-md-3 left " style="height: 480px;">

    <div class="profile-card text-center p-3 shadow-sm rounded bg-white">

        <!-- ✅ صورة البروفايل مع أيقونة تعديل -->
        <div class="position-relative d-inline-block mb-3" style="width: 136px; height: 136px; margin-top: 40px">
        <img src="{{ asset('public/images/profile/default.png') }}"
            class="profile-img"
            alt="Profile"
            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
        </div>

        <!-- الاسم ورقم الكود -->
        <h5 style="font-size: 22px;  font-family: 'NowB', sans-serif;" class="mb-3 mt-3 fw-semibold">{{ $user->name }}</h5>

        <hr class="mb-5 mt-5">
        <!-- رابط الحساب -->
        <div class="input-group mb-4 mt-4 justify-content-center align-items-center flex-column text-center">
            <p style="font-size: 16px; font-family: 'NowM', sans-serif;">Email: {{ $user->email }}</p>
            <p style="font-size: 16px; font-family: 'NowM', sans-serif;">Phone: {{ $user->phone }}</p>
        </div>

    </div>

    </div>


    <!-- Center: Info Tabs -->
    <div class="col-md-9 middle mb-5">
  <div class="profile-card">
    <ul class="nav nav-tabs mb-3" id="infoTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">Your Subscription</button>
      </li>
    </ul>

    <div class="tab-content text-center py-4">
        <h4 class="title mb-3">Choose Your Voting Package</h4>
        <p class="subtitle mb-4">
            Select from our various packages to vote for your favorite <br> real estate Sales and help them win the competition.
        </p>

                <!-- قسم الباقات -->
        <div id="packages-section" class="row justify-content-center px-3 ">
        <!-- Package 1 -->
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card border-0 p-3 text-center">
            <h5 class="mb-3">Basic Package</h5>
            <p class="mb-2">$1</p>
            <p class="text-muted mb-3">10 Votes</p>
            <button class="btn btn-dark btnText ">Select Package</button>
            </div>
        </div>

        <!-- Package 2 -->
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card border-0 p-3 text-center">
            <h5 class="mb-3">Basic Package</h5>
            <p class="mb-2">$5</p>
            <p class="text-muted mb-3">60 Votes</p>
            <button class="btn btn-dark btnText ">Select Package</button>
            </div>
        </div>

        <!-- Package 3 -->
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card border-0 p-3 text-center">
            <h5 class="mb-3">Basic Package</h5>
            <p class="mb-2">$10</p>
            <p class="text-muted mb-3">150 Votes</p>
            <button class="btn btn-dark btnText ">Select Package</button>
            </div>
        </div>

        <!-- Package 4 -->
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card border-0 p-3 text-center">
            <h5 class="mb-3">Basic Package</h5>
            <p class="mb-2">$20</p>
            <p class="text-muted mb-3">350 Votes</p>
            <button class="btn btn-dark btnText ">Select Package</button>
            </div>
        </div>
        </div>

        <!-- شاشة الخصم (داخل Overlay شفاف) -->
        <div id="overlay" class="overlay">
            <form id="discount-section" class="popup text-center p-4 rounded" method="POST">
                @csrf
                <h5 class="discount-title mb-3">Discount Code</h5>

                <div class="d-flex justify-content-center mb-3">
                <input
                    type="text"
                    name="discount_code"
                    class="form-control text-center "
                    placeholder="Enter your code"
                    required>
                </div>

                <button type="submit" class="btn btn-dark px-4 mb-4 w-100" style="background-color: #000000;" id="done-btn">Done</button>

                <p class="discount-subtitle mb-3 mt-4">To download the application:</p>
                <div class="d-flex justify-content-center gap-3">
                <a href="#">
                    <img src="{{ asset('public/images/profile/app.png') }}" alt="App Store" style="width:105px">
                </a>
                <a href="#">
                    <img src="{{ asset('public/images/profile/google.png') }}" alt="Google Play" style="width:105px">
                </a>
                </div>
            </form>
            </div>

    </div>



</div>

  </div>
</div>


  </div>


@endsection






<!-- ===== JavaScript ===== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const overlay = document.getElementById('overlay');
  const selectButtons = document.querySelectorAll('.select-package');
  const doneBtn = document.getElementById('done-btn');

  // عند الضغط على أي زر "Select Package"
  selectButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      overlay.classList.add('show');
    });
  });

  // عند الضغط على زر "Done"
  doneBtn.addEventListener('click', () => {
    overlay.classList.remove('show');
  });

  // عند الضغط خارج البوكس الأبيض
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.classList.remove('show');
    }
  });
});
</script>
