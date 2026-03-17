<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('public/images/Fav.webp') }}" rel="icon" type="image/x-icon">

  <title>{{ __('sign.forgot_title') }} - All Stars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    .titleHead{
        font-size:26px;
        font-family:'NowM', sans-serif;
    }
    .titleHead2{
        font-size:14px;
        font-family:'NowR', sans-serif;
        color:#667085;
    }
    @media (max-width: 768px) {
        .titleHead{
            font-size:25px;
        }
        .titleHead2{
            font-size:14px;
        }
    }

    .auth-form:focus-within {
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.25); /* primary-100 style */
        }



        .forgot-link {
        display: inline-block;
        font-family: 'NowM', sans-serif;
        font-size: 14px;
        color: var(--ink-900);
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

  </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row auth-container">

      <!-- Left: Form -->
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <div class="d-flex bg-white">
            <div class="auth-form shadow-sm p-4 bg-white rounded"
                style="max-width: 700px; transition: box-shadow 0.3s ease; width:100%;">

                <h2 class="text-center mb-2 titleHead">
                    {{ __('sign.forgot_title') }}
                </h2>

                <h2 class="text-center mb-4 titleHead2">
                    {{ __('sign.forgot_subtitle') }}
                </h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert" style="font-family:'NowR', sans-serif;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">{{ __('sign.phone') }}</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="{{ __('sign.phone_placeholder') }}"
                            value="{{ old('phone') }}"
                            required
                            autofocus
                        >
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('sign.new_password') }}</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('sign.new_password_placeholder') }}"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('sign.confirm_password') }}</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="{{ __('sign.confirm_password_placeholder') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-dark w-100"
                            style="font-family:'NowM', sans-serif; font-size:16px;">
                        {{ __('sign.update_password') }}
                    </button>

                    <div class="text-center mt-3">
                        <small style="font-family:'NowR', sans-serif; font-size:14px; color:#667085;">
                            {{ __('sign.remembered_password') }}
                            <a href="{{ route('login') }}" class="text-dark"
                               style="font-family:'NowM', sans-serif; font-size:16px;">
                                {{ __('sign.sign_in') }}
                            </a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
      </div>

      <!-- Right: Image -->
      <div class="col-lg-6 auth-image"></div>

    </div>
  </div>

</body>
</html>
