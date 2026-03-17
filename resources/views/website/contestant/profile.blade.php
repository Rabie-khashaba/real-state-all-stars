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
        .info-label {
        font-weight: bold;
        color: #555;
        }
        .section-title {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 18px;
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

        .info-label {
            text-align: left; /* الكلمة على اليمين */
            width: 150px; /* طول ثابت للـ label */
            padding-right: 20px;
            font-family: 'NowM', sans-serif;
            font-size: 10px;

        }

        .info-value {
            text-align: center; /* القيمة في منتصف الخانة */
            font-family: 'NowR', sans-serif;
            font-size: 10px;
            color: #667085;
        }

        .section-title{
            font-family: 'NowB', sans-serif;
            font-size: 13px;
        }
        table td {
            font-family: 'NowM', sans-serif;
            font-size: 10px;
        }


        .cricle{
            display: inline-block;
            background: #D9D9D9;
            border-radius: 20px;
            padding: 5px 5px;
            font-family: 'NowR', sans-serif;
            font-size: 10px;
            color: #7D8288;
        }




        .nav-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            border-bottom: 2px solid #ccc; /* الخط الأساسي تحت التابات */
            position: relative;
        }

  /* لون الزر العادي (غير active) */
        .nav-tabs .nav-link {
            color: #9F9898;
            border: none;
            background: transparent;
            margin-bottom: -17px;
        }

        /* لون الزر عند التفعيل */
        .nav-tabs .nav-link.active {
            color: #000; /* أو أي لون تريده */
            border-bottom: 2px solid #000; /* ممكن تشيلها لو مش عايز خط */
            background-color: transparent;
            position: relative;
            z-index: 2; /* عشان يكون فوق الخط الرمادي */
            margin-bottom: -17px;

        }


        @media (max-width: 768px) {
        .nav-tabs .nav-link {
                font-size: 14px; /* ← حجم خط أصغر */

            }
        }

        .btnsa{
            width:63px;
            border-radius:9px;
            background-color:#FFB5B5;
            font-size:8px;
            font-family: 'NowB', sans-serif;
            color: #FF0000;
        }

        .btnssa{
            width:63px;
            border-radius:9px;
            background-color:#9BE8A4;
            font-size:10px;
            font-family: 'NowB', sans-serif;
            color: #00790E;
        }

        .pA{
            font-size: 12px;
            font-family: 'NowR', sans-serif;
        }



        .upload-loader-overlay1 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(5px);
        z-index: 999999999999999; /* أعلى من أي عنصر */
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-align: center;
    }


    .loader-content1 h4 {
        margin-top: 15px;
        font-size: 22px;
        font-weight: 600;
        font-family: 'NowR', sans-serif;
    }

    .loader-content1 p {
        font-size: 14px;
        opacity: 0.8;
    }

    /* Spinner */
    .spinner1 {
        width: 70px;
        height: 70px;
        border: 6px solid #fff;
        border-top: 6px solid #FFB400;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    
     .share-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .share-popup {
            background: #fff;
            padding: 25px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease;
            width: 300px;
        }
        
        .share-popup h5 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .share-buttons a {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }
        
        .share-buttons a:hover {
            transform: scale(1.1);
            opacity: 0.85;
        }
        
        /* ألوان المنصات */
        .whatsapp { background-color: #25D366; }
        .facebook { background-color: #1877F2; }
        .twitter  { background-color: #1DA1F2; }
        
        .copy-link {
            background-color: #f1f1f1;
            color: #333;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        
        .copy-link:hover {
            background-color: #e0e0e0;
        }
        
        .copy-success {
            color: #28a745;
            margin-top: 10px;
            font-size: 14px;
            display: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        
        .personal-info-ltr {
            direction: ltr !important;
            text-align: left !important;
        }

        .personal-info-ltr .info-table {
            direction: ltr !important;
        }

        .personal-info-ltr .info-label {
            text-align: left !important;
        }

        .personal-info-ltr .info-value {
            text-align: center !important;
        }
        
        .btn-black {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #000 !important;
        }
        
        .btn-black:hover {
            background-color: #111 !important;
            border-color: #111 !important;
        }




</style>
@endsection

@section('content')


<div id="videoUploadLoader" class="upload-loader-overlay1" style="display:none;">
    <div class="loader-content1">
        <div class="spinner1"></div>
        <h4>Uploading your video...</h4>
        <p>Please wait, this may take a few seconds</p>
    </div>
</div>


    {{--section 1--}}
<section class="hero">
        <div class="container hero-content justify-content-center d-flex flex-column py-5">
            <!-- Headings -->

        </div>
</section>






<div class="container ">
    <div class="row g-4">

    <div class="col-md-3 left mb-5 " style="height: 466px;">
    <div class="profile-card text-center p-3 shadow-sm rounded bg-white">

        <!-- ✅ صورة البروفايل مع أيقونة تعديل -->
        <div class="position-relative d-inline-block mb-3" style="width: 180px; height: 180px;">
        <img src="{{ asset('storage/app/public/' . $contestant->profile_photo_path) ?? '' }}"
            class="profile-img"
            alt="Profile"
            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">





        <!-- ✅ أيقونة الكاميرا مضبوطة بدقة -->
        <button class="btn position-absolute"
                style="
                    bottom: 5px;
                    right: 5px;
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background-color: #fff;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
                    padding: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
            <i class="bi bi-camera-fill text-dark" style="font-size: 16px;"></i>
        </button>
        </div>

        <!-- الاسم ورقم الكود -->
        <h5 style="font-size: 22px;  font-family: 'NowB', sans-serif;" class="mb-1 fw-semibold">{{$contestant->user->name}}</h5>
        <h6 class="text-muted mb-3" style="font-size: 36px; font-family: 'NowB', sans-serif; color: #7D8288">{{$contestant->user_id  +1000}}</h6>

        <!-- عدد التصويتات -->
        <div class="my-3">
        <div class="d-flex align-items-center">
            <hr class="flex-grow-1 border-secondary m-0">
            <span class="px-3 fw-semibold" style="font-family: 'NowB', sans-serif; font-size: 16px;">
            {{__('profile.Total Votes')}}: <strong>{{$contestant->votes_count}}</strong>
            </span>
            <hr class="flex-grow-1 border-secondary m-0">
        </div>
        </div>
        <!-- رابط الحساب -->
        <h5 style="font-size: 16px;  font-family: 'NowM', sans-serif;" class="mb-3">{{__('profile.Share account')}}</h5>


        <div class="input-group mb-2">
            <input type="text" class="form-control form-control-sm text-center" 
                   value="https://realestateallstars.online/contestant/{{ $contestant->user_id }}" 
                   id="contestant-link-{{ $contestant->id }}" readonly>
            <span class="input-group-text bg-white border-start-0" style="cursor: pointer;"
                  onclick="openShareOptions('https://realestateallstars.online/contestant/{{ $contestant->user_id }}')">
                <i class="bi bi-share-fill" style="font-size: 18px; color: #000;"></i>
            </span>
        </div>

    </div>
    </div>


    <!-- Center: Info Tabs -->
    <div class="col-md-6 middle mb-5">
        <div class="profile-card">
            <ul class="nav nav-tabs mb-3" id="infoTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">{{__('profile.Inforamtion')}}</button>
                </li>

                @if(isset($contestant) && $contestant->status === 'approved')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button">
                            {{__('profile.Video Submissions')}}
                        </button>
                    </li>
                @endif
            </ul>

        <!-- <ul class="nav nav-tabs custom-tabs justify-content-between" id="myTab" role="tablist">
            <li  class="nav-item tabBtn" role="presentation">
                <button class="nav-link active " id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                        type="button" role="tab">Information</button>
            </li>
            <li class="nav-item tabBtn" role="presentation">
                <button class="nav-link " id="video-tab" data-bs-toggle="tab" data-bs-target="#video"
                        type="button" role="tab">Video Submissions</button>
            </li>
        </ul> -->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="info">
            <!-- Personal Info -->
            <div class="mb-3 personal-info personal-info-ltr">
                <div class="section-title">Personal Information</div>

                <table class="info-table" style="margin-left: 20px;">
                    <tr>
                        <td class="info-label">Date of Birth:</td>
                        <td class="info-value">{{$contestant->dob}}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Nationality:</td>
                        <td class="info-value">{{ $contestant->nationality->name_en }}</td>
                    </tr>

                </table>
            </div>


            <!-- Professional Info -->
            <!-- Professional Info -->
        <div class="mb-3 personal-info personal-info-ltr">
            <div class="section-title">Professional Information</div>

            <div class="row">
                <!-- First Pair: Experience + Current Employer -->
                <div class="col-5" style="margin-left: 20px;">
                    <span  class="info-label">Years of Experience</span><br>
                    <span class="info-value">{{ $contestant->experience }}</span>
                </div>
                <div class="col-5" style="margin-left: 20px;">
                    <span class="info-label">Current Employer</span><br>
                    <span class="info-value">{{ $contestant->employer }}</span>
                </div>
            </div>
            <hr>
            <div class="row flex-wrap">
                <!-- Second Pair: Expertise + Destination -->
                <div class="d-flex flex-wrap col-12 col-md-6 mb-2">
                    @php
                        $expertise = is_string($contestant->expertise_areas) ? json_decode($contestant->expertise_areas, true) : $contestant->expertise_areas;
                    @endphp

                    @if(!empty($expertise) && is_array($expertise))
                        <div class="me-2 mb-2">
                            <span class="info-label">Area of Expertise</span><br>

                            @foreach($expertise as $key => $value)
                                <span class="info-value cricle">{{ ucfirst($value) }}</span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-muted">No expertise added</span>
                    @endif

                </div>
                <div class="d-flex flex-wrap col-12 col-md-6 mb-2">
                    @php
                        $destinations = is_string($contestant->destinations) ? json_decode($contestant->destinations, true) : $contestant->destinations;
                    @endphp

                    @if(!empty($destinations) && is_array($destinations))
                        <div class="me-2 mb-2">
                            <span class="info-label">Destination of Expertise</span><br>

                            @foreach($destinations as $region => $areas)
                                @if(is_array($areas))
                                    @foreach($areas as $area)
                                        <span class="info-value cricle">{{ $area }}</span>
                                    @endforeach
                                @else
                                    <span class="info-value cricle">{{ $areas }}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif



                </div>
            </div>
        <hr>

        </div>
            <!-- Additional Info -->
            <div class="mb-3 personal-info personal-info-ltr">
                    <div class="section-title">Additional Information</div>
                    <p class="info-value text-start" style="margin-left: 20px;">
                        <strong class="info-label">Why do you want to participate in Real Estate All-Stars?</strong><br>
                        {{ $contestant->participation_reason }}
                        <!--<a style="color: #000;" href="#">See more</a>-->
                    </p>
                    <br>
                    <p class="info-value text-start" style="margin-left: 20px;">
                        <strong class="info-label">Why do you want to participate in Real Estate All-Stars?</strong><br>
                        {{ $contestant->standout_reason }}
                        <!--<a style="color: #000;" href="#">See more</a>-->
                    </p>
                </div>
        </div>

        <!-- Video Tab -->
            <div class="tab-pane fade" id="video">
                @include('website.contestant.videoSubmission')
            </div>
        </div>
        </div>
    </div>

    {{-- ✅ Account Activated --}}
    <div class="col-md-3 right mb-5" style="height: 466px;">
        <div class="activation-box p-3 border rounded">
           <form action="{{ route('vote', $contestant->id) }}" method="POST" class="d-inline vote-form">
                @csrf
                <button type="submit" class="btn btn-black btn-sm">{{__('profile.Vote')}}</button>
            </form>

           {{-- <form action="{{ route('interest.toggle', $contestant->id) }}" method="POST" class="d-inline interest-form">
                @csrf
                <button type="submit" 
                    class="btn btn-warning btn-sm"
                    @if(auth()->user()->hasInterested($contestant->id))
                        style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                    @endif
                >Interested</button>
            </form> --}}
            
            <form 
                action="{{ route('interest.toggle', $contestant->id) }}" 
                method="POST" 
                class="d-inline interest-form"
            >
                @csrf
                @php
                    $isInterested = auth()->check() && auth()->user()->hasInterested($contestant->id);
                @endphp
            
                <button 
                    type="submit"
                    class="btn btn-sm {{ $isInterested ? 'btn-gold' : 'btn-warning' }}"
                    @if($isInterested)
                        style="background: linear-gradient(90deg, #F8DA58, #C79720); color: #000;"
                    @endif
                    @guest
                        onclick="return confirm('يرجى تسجيل الدخول أولاً لمتابعة هذا المتسابق.')"
                    @endguest
                >
                    {{__('profile.Interested')}}
                </button>
            </form>


        </div>
    </div>


    </div>
</div>



@endsection

<script>






document.getElementById('copyBtn').addEventListener('click', async function() {
    const codeInput = document.getElementById('activationCode');
    const copyIcon = document.getElementById('copyIcon');

    try {
        // نسخ النص باستخدام Clipboard API الحديث
        await navigator.clipboard.writeText(codeInput.value);

        // تغيير الأيقونة لفترة قصيرة
        copyIcon.classList.remove('bi-clipboard');
        copyIcon.classList.add('bi-clipboard-check');

        setTimeout(() => {
            copyIcon.classList.remove('bi-clipboard-check');
            copyIcon.classList.add('bi-clipboard');
        }, 1500);

    } catch (err) {
        console.error('Failed to copy: ', err);
    }
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vote AJAX


    // Interested AJAX
    document.querySelectorAll('.interest-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let url = form.action;
            let token = form.querySelector('input[name="_token"]').value;
            let button = form.querySelector('button');
            let messageEl = form.nextElementSibling;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(res => res.json())
            .then(data => {
                /* messageEl.style.display = 'block';
                messageEl.textContent = data.message; */
                if (data.isInterested) {
                    button.style.background = 'linear-gradient(90deg, #F8DA58, #C79720)';
                    button.style.color = '#000';
                } else {
                    button.style.background = '';
                    button.style.color = '';
                }
            })
            .catch(err => console.error(err));
        });
    });
});






</script>



@php
    $messages = [
        'shareMessage' => __('popup.share_contestant'),
        'shareTitle'   => __('popup.share_via'),
        'copyBtn'      => __('popup.copy_link'),
        'copySuccess'  => __('popup.copy_success'),
    ];
@endphp

<script>
    const messages = {!! json_encode($messages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!};

    function openShareOptions(url) {
        const encoded = encodeURIComponent(messages.shareMessage + ' ' + url);
        const whatsapp = `https://wa.me/?text=${encoded}`;
        const facebook = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        const twitter = `https://twitter.com/intent/tweet?text=${encoded}`;

        // حذف أي popup قديم
        document.querySelectorAll('.share-popup-overlay').forEach(el => el.remove());

        const popup = `
            <div class="share-popup-overlay" onclick="this.remove()">
                <div class="share-popup" onclick="event.stopPropagation()">
                    <h5>${messages.shareTitle}</h5>
                    <div class="share-buttons d-flex gap-3 justify-content-center mb-2">
                        <a href="${whatsapp}" class="whatsapp btn btn-success" target="_blank">
                            <i class="bi bi-whatsapp"></i> 
                        </a>
                        <a href="${facebook}" class="facebook btn btn-primary" target="_blank">
                            <i class="bi bi-facebook"></i> 
                        </a>
                        <a href="${twitter}" class="twitter btn btn-info" target="_blank">
                            <i class="bi bi-twitter"></i> 
                        </a>
                    </div>
                    <button class="copy-link btn btn-outline-dark w-100" onclick="copyToClipboard('${url}', this)">
                        ${messages.copyBtn}
                    </button>
                    <div class="copy-success text-success text-center mt-2" style="display:none;">
                        ${messages.copySuccess}
                    </div>
                </div>
            </div>`;

        document.body.insertAdjacentHTML('beforeend', popup);
    }

    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const successMsg = btn.nextElementSibling;
            successMsg.style.display = 'block';
            setTimeout(() => successMsg.style.display = 'none', 2000);
        });
    }
</script>



