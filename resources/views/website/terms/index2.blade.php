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
        .headTitle{
            font-family: 'NowM', sans-serif;
            font-size: 45px;
        }

        .subtitle{
            font-family: 'NowM', sans-serif;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .para{
            font-family: 'NowM', sans-serif;
            font-size: 16px;
            line-height: 30px;
            color: #667085;
            margin-bottom: 30px;
        }

        @media (max-width: 767px) {
            .headTitle{
            font-size: 30px;
            }
            .subtitle{
            font-size: 24px;
            }
            .para{
                font-family: 'NowM', sans-serif;
                font-size: 16px;
                line-height: 30px;
                color: #667085;
                margin-bottom: 30px;
            }
        }





</style>



@endsection

@section('content')

<section class="py-5">
  <div class="container">

    @if($term)
    <h2 class=" headTitle" style="font-family: 'NowB', sans-serif;">
        {{ $locale === 'ar' ? 'الشروط والأحكام' : 'Terms of Service' }}
    </h2>
    <hr class="mb-4" style="border-top: 2px solid #000; width: 100%;">
        <!-- عرض المحتوى حسب اللغة -->
        <div class="terms-content">
            {!! $content !!}
        </div>
    @else
        <!-- في حالة عدم وجود بيانات -->
        <div class="alert alert-info">
            <p class="para">
            {{ $locale === 'ar' ? 'لا يوجد محتوى متاح.' : 'No terms content available.' }}
            </p>
        </div>
    @endif
  </div>
</section>

<style>
    .terms-content {
        font-family: 'NowM', sans-serif;
    }

    .terms-content h2,
    .terms-content .headTitle {
        font-family: 'NowB', sans-serif;
        font-size: 45px;
        margin-bottom: 20px;
    }

    .terms-content h4,
    .terms-content h5,
    .terms-content .subtitle {
        font-family: 'NowM', sans-serif;
        font-size: 24px;
        margin-bottom: 30px;
    }

    .terms-content p,
    .terms-content .para {
        font-family: 'NowM', sans-serif;
        font-size: 16px;
        line-height: 30px;
        color: #000000;
        margin-bottom: 15px;
    }

    .terms-content hr {
        border-top: 2px solid #000;
        width: 100%;
        margin-bottom: 30px;
    }

    @media (max-width: 767px) {
        .terms-content h2,
        .terms-content .headTitle {
            font-size: 30px;
        }

        .terms-content h4,
        .terms-content h5,
        .terms-content .subtitle {
            font-size: 24px;
        }

        .terms-content p,
        .terms-content .para {
            font-size: 16px;
            line-height: 30px;
        }
    }
</style>

@endsection



