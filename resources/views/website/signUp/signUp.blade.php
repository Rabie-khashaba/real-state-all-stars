<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('public/images/Fav.webp') }}" rel="icon" type="image/x-icon">

  <title>Create Account - All Stars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-75515DCPTW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-75515DCPTW');
</script>

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
    body {
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
    }

    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: stretch;
      flex-wrap: wrap;
    }

    .auth-form {
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .auth-form h2 {
      font-weight: 600;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px 12px;
    }

    .btn-dark {
      border-radius: 8px;
      padding: 10px;
      font-weight: 500;
      width: 100%;
    }

    .auth-image {
      background: url("{{ asset('public/images/signIn/create.png') }}") no-repeat center center/contain;
      min-height: 100vh;
      min-width: 50%;
    }

    /* --- Responsive --- */
    @media (max-width: 991px) {
      .auth-image {
        order: -1; /* يجعل الصورة تظهر فوق الفورم */
        min-height: 40vh; /* نصف الشاشة في الموبايل */
        width: 100%;
        background-size: cover; /* تملأ الشاشة بدون فراغ */
        background-position: center center;
      }

      .auth-form {
        padding: 20px;
      }
    }

    .form-label{
        font-family: 'NowM', sans-serif;
        font-size: 15px;
    }

    input::placeholder{
        font-family: 'NowR', sans-serif;
        font-size: 12px;
        color: #667085;
    }


  </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row auth-container">


      <!-- Left: Form -->
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <div class="auth-form w-100" style="max-width: 400px;">
             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif
          <h2 style="font-size:30px; font-family: 'NowM', sans-serif;">{{ __('sign.create_account') }}</h2>
          <form action="{{route('voter.store')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">{{ __('sign.full_name') }}</label>
              <input type="text" name="name" class="form-control" placeholder="{{ __('sign.full_name_placeholder') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('sign.phone') }}</label>
              <input type="text" name="phone" class="form-control" placeholder="{{ __('sign.phone_placeholder') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('sign.email') }}</label>
              <input type="email" name="email" class="form-control" placeholder="{{ __('sign.email_placeholder') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('sign.password') }}</label>
              <input type="password"name="password" class="form-control" placeholder="{{ __('sign.password_placeholder') }}">
            </div>

            <button style="font-family: 'NowM', sans-serif; font-size:16px" type="submit" class="btn btn-dark"> {{ __('sign.sign_up') }}</button>

            <div class="text-center mt-3">
              <small style="font-family: 'NowR', sans-serif; font-size:14px ; color:#667085">{{ __('sign.have_account') }} <a href="{{url('signIn')}}" class="text-dark" style="font-family: 'NowM', sans-serif; font-size:16px">{{ __('sign.sign_in') }}</a></small>
            </div>
          </form>
        </div>
      </div>


        <!-- Right: Image (تظهر فوق في الموبايل بسبب order) -->
      <div class="col-lg-6 auth-image"></div>

    </div>
  </div>

</body>
</html>
