<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>OTP Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>

       @font-face { font-family: 'NowR'; src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype'); }
    @font-face { font-family: 'NowB'; src: url("{{ asset('public/font/Now-Bold.otf') }}") format("opentype"); }
    @font-face { font-family: 'NowM'; src: url("{{ asset('public/font/Now-Medium.otf') }}") format("opentype"); }

    body{ margin:0; padding:0; height:100vh; background:#fff; display:flex; align-items:center; justify-content:center; }
    .otp-box{ width:100%; max-width:680px; background-image:url("{{asset('public/images/contestant/image.png')}}");
      background-size:cover; background-position:center; border-radius:20px; padding:40px 30px; text-align:center;
      box-shadow:0 4px 30px rgba(0, 0, 0, 0.1); color:#222; }
    .overlay{ border-radius:20px; padding:30px 25px; }
    .otp-inputs input{ width:60px; height:60px; text-align:center; font-size:24px; border:1px solid #ccc; border-radius:12px; margin:0 5px; background:#fff; }
    .otp-inputs input:focus{ border-color:#000; box-shadow:0 0 0 0.2rem rgba(0,0,0,0.2); outline:none; }
    .btn-black{ background:#000; color:#fff; width:30%; border-radius:12px; padding:12px; font-size:16px; font-weight:600; margin-top:25px; }
    .title{ font-family:'NowM', sans-serif; font-size:35px; }
    .subtitle{ font-family:'NowR', sans-serif; font-size:16px; }
    .num{ font-family:'NowB', sans-serif; font-size:16px; }
    .resend-text{ margin-top:15px; font-size:13px; color:#555; }
    .resend-text button{ background:none; border:none; padding:0; color:#000; text-decoration:underline; font-weight:500; cursor:pointer; }
    .resend-button{ display:none; }



  </style>
</head>
<body>

  <div class="otp-box">
    <div class="overlay">
      <h4 class="title">Enter Verification Code</h4>
      <p class="subtitle">We’ve sent a code to <span class="num">{{ $phone ?? 'â€”' }}</span></p>

      @if(session('success'))
        <div class="alert alert-success text-start">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger text-start">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Ù„Ù„ØªØ¬Ø±Ø¨Ø© ÙÙ‚Ø· --}}
      <!--@if (!empty($debug_code))-->
      <!--  <div class="alert alert-warning text-start">-->
      <!--    DEBUG OTP: <b>{{ $debug_code }}</b>-->
      <!--  </div>-->
      <!--@endif-->

      <form method="POST" action="{{ route('contestant.otp.verify') }}" id="otpForm">
        @csrf

        @if(!empty($token))
          <input type="hidden" name="t" value="{{ $token }}">
        @endif

        <input type="hidden" name="otp" id="otpHidden">

        <div class="otp-inputs d-flex justify-content-center mb-3">
          <input type="text" inputmode="numeric" maxlength="1" class="form-control otp-digit" />
          <input type="text" inputmode="numeric" maxlength="1" class="form-control otp-digit" />
          <input type="text" inputmode="numeric" maxlength="1" class="form-control otp-digit" />
          <input type="text" inputmode="numeric" maxlength="1" class="form-control otp-digit" />
        </div>

        <button class="btn btn-black" type="submit">Verify</button>
      </form>

      <div class="resend-text">
        Didn't get a code?
        <span class="ms-1">Resend in <span id="resendTimer">60</span>s</span>
        <form method="POST" action="{{ route('contestant.otp.resend') }}" class="d-inline" id="resendForm">
          @csrf
          @if(!empty($token))
            <input type="hidden" name="t" value="{{ $token }}">
          @endif
          <button type="submit" class="resend-button" id="resendButton">Click to resend</button>
        </form>
      </div>

    </div>
  </div>

  <script>
    const inputs = document.querySelectorAll('.otp-digit');
    const hidden = document.getElementById('otpHidden');
    const form = document.getElementById('otpForm');

    function syncHidden(){
      hidden.value = Array.from(inputs).map(i => i.value || '').join('');
    }

    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        input.value = input.value.replace(/\D/g,'');
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
        syncHidden();
      });

      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && index > 0) {
          inputs[index - 1].focus();
        }
      });

      input.addEventListener('paste', (e) => {
        const text = (e.clipboardData || window.clipboardData).getData('text');
        const digits = (text || '').replace(/\D/g,'').slice(0,4).split('');
        digits.forEach((d, i) => { if (inputs[i]) inputs[i].value = d; });
        syncHidden();
        e.preventDefault();
      });
    });

    form.addEventListener('submit', (e) => {
      syncHidden();
      if (hidden.value.length !== 4) {
        e.preventDefault();
        alert('Please enter the 4-digit code.');
      }
    });
    const resendTimer = document.getElementById('resendTimer');
    const resendButton = document.getElementById('resendButton');
    let secondsLeft = 60;

    const timerId = setInterval(() => {
      secondsLeft -= 1;
      if (secondsLeft <= 0) {
        clearInterval(timerId);
        resendTimer.textContent = '0';
        resendButton.style.display = 'inline';
        return;
      }
      resendTimer.textContent = String(secondsLeft);
    }, 1000);
    inputs[0].focus();
  </script>

</body>
</html>

