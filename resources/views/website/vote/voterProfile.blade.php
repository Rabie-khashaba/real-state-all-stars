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

    <div class="col-md-3 left " style="height: 466px;">
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

        <hr>
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

    <div class="tab-content text-center py-4" >
        <img src="{{ asset('public/images/profile/error.png') }}" alt="No Subscription" class="mb-3">

        <p class="mb-2 mt-1" style="font-size: 14px; font-family: 'NowB', sans-serif;">
            You don't have any subscription yet.
        </p>

        <a href="{{url('voter/package/' . auth()->user()->id)}}" class="btn btn-dark mt-3 px-4 py-2" style="font-size: 14px; font-family: 'NowM', sans-serif; border-radius: 8px;">
            Choose your package for more votes
        </a>

    </div>
  </div>
</div>




  </div>


@endsection






