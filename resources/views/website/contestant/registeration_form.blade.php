@extends('website.layouts.master2')

@section('title', 'Registration Form')


<style>
    @font-face {
        font-family: 'NowR';
        /* الاسم اللي هتستخدمه لاحقًا */
        src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'NowB';
        /* الاسم اللي هتستخدمه لاحقًا */
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


    .main-heading {
        font-family: 'NowM', sans-serif;
        line-height: 27px;
        font-size: 37px;
    }

    .spanText {
        font-family: 'NowR', sans-serif;
        color: #F8DA58
    }

    .description-text {
        font-family: 'NowR', sans-serif;
        font-size: 35px;
        margin-top: 15px;
    }

    .headline-start {
        padding-left: 25px;
    }


    @media (max-width: 576px) {

        .main-heading {
            font-size: 24px;
            line-height: 30px;
            padding-top: 30px;
        }

        .description-text {
            font-size: 18px;
        }

        .hero .container {
            padding-left: 10px !important;
            padding-right: 10px !important;
            margin-left: 0;
            margin-right: 0;
            max-width: 100% !important;
            /* يخليها full width */
        }

        .text-wrapper {
            text-align: center !important;
        }

        .headline-start {
            text-align: center !important;
        }

    }

    .labelName {
        font-family: 'NowM', sans-serif;
        font-size: 14px;
        line-height: 20px;
    }



    input::placeholder {
        font-size: 12px;
        color: #e6e8e8;
        /* optional: lighter color */
        font-family: 'NowR', sans-serif;
    }

    input {
        border-radius: 8px !important;
        border: 1px solid #D0D5DD !important;

    }

    .check_input {
        width: 20px;
        height: 20px;
        border-radius: 1px;
        margin-right: 10px;
        color: #fff;
        border: 1px solid #8D8D8D !important;
        background: #D9D9D9;
    }

    .labelcheck {
        font-family: 'NowR', sans-serif;
        font-size: 12px;
    }

    .confirmCheck {
        margin-top: 5px;
        font-family: 'NowR', sans-serif;
        font-size: 12px;
    }

    @media (max-width: 576px) {
        .confirmCheck {
            font-family: 'NowR', sans-serif;
            font-size: 10px;
        }
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        /* لون الخلفية */
        border-color: #0d6efd;
        /* لون البوردر */
    }

    .form-check-input:checked[type="checkbox"] {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='white' d='M13.485 1.929l-7.071 7.071-3.536-3.536L1.465 7.879l4.949 4.95 8.485-8.486z'/%3e%3c/svg%3e");
        background-size: 12px 12px;
        background-position: center;
        background-repeat: no-repeat;
    }

    .photo-upload {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #e0e0e0;
        position: relative;
        text-align: center;
        cursor: pointer;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Arial', sans-serif;
    }

    .photo-upload input[type="file"] {
        display: none;
    }

    .photo-upload .icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #5a5a5a;
        font-size: 12px;
    }

    .photo-upload .icon img {
        width: 40px;
        height: 40px;
        margin-bottom: 5px;
    }

    .headTitle {
        font-size: 30px;
        font-family: 'NowR', sans-serif;
    }

    @media (max-width: 576px) {
        .headTitle {
            font-size: 22px;
            font-family: 'NowR', sans-serif;
        }
    }
</style>

<style>
    .photo-upload-area {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 2px dashed #999;
        background: #fafafa;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: 0.3s;
    }

    .photo-upload-area:hover {
        background: #f0f0f0;
        border-color: #666;
    }

    .photo-upload-area .camera-icon {
        font-size: 32px;
        color: #666;
        transition: 0.3s;
    }

    .photo-upload-area:hover .camera-icon {
        color: #000;
    }

    #previewImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        display: none;
    }


    .upload-loader-overlay1 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loader-content1 {
        text-align: center;
    }

    .spinner1 {
        width: 60px;
        height: 60px;
        border: 6px solid #ddd;
        border-top-color: #000;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }



    .upload-btn {
        width: 120px;
        background-color: #000 !important;
        border-color: #000 !important;
        color: #fff !important;
        justify-content: center;
        text-align: center;
        font-family: 'NowM', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #fff !important;
        color: #000 !important;
    }

    input[type="file"].form-control {
        border-right: none;
        border-radius: 8px 0 0 8px !important;
    }

    .input-group-text.upload-btn {
        border-radius: 0 8px 8px 0 !important;
        display: flex;
        align-items: center;
    }

    .video-upload-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        font-family: 'NowR', sans-serif;
        font-size: 16px;
        color: #475467;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e4e7ec;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .video-upload-status.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .video-upload-spinner {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: conic-gradient(#111 0deg 90deg, #e4e7ec 90deg 360deg);
        -webkit-mask: radial-gradient(farthest-side, transparent 55%, #000 56%);
        mask: radial-gradient(farthest-side, transparent 55%, #000 56%);
        animation: spin 0.9s linear infinite;
        display: none;
    }

    .video-upload-text {
        display: none;
        font-weight: 600;
        color: #475467;
        font-size: 18px;
    }

    .video-upload-status.is-active .video-upload-spinner,
    .video-upload-status.is-active .video-upload-text {
        display: inline-flex;
    }

    .registration-video-modal .modal-content {
        border-radius: 18px;
        overflow: hidden;
        background: #0b0b0b;
        color: #fff;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
    }

    .registration-video-modal .modal-body {
        padding: 0 24px 28px;
    }

    .registration-video-modal .modal-dialog {
        max-width: 980px;
    }

    .registration-video-modal .modal-backdrop.show {
        opacity: 0.75;
    }

    .registration-video-header {
        padding: 16px 20px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0));
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .registration-video-title {
        font-family: 'NowM', sans-serif;
        font-size: 16px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.72);
        margin: 0;
    }

    .registration-video-actions {
        gap: 10px;
    }

    .registration-video-actions .rewatch-btn {
        background: #ffffff;
        color: #0b0b0b;
        border: none;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
    }

    .registration-video-actions .rewatch-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .registration-video-actions .btn-close {
        filter: invert(1);
        opacity: 0.7;
        transition: opacity 0.2s ease;
    }

    .registration-video-actions .btn-close:hover {
        opacity: 1;
    }

    .registration-video-modal .ratio {
        border-radius: 14px;
        overflow: hidden;
        background: #000;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
    }

    .registration-video-modal iframe,
    .registration-video-modal video {
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media (max-width: 768px) {
        .registration-video-modal .modal-body {
            padding: 0 16px 22px;
        }

        .registration-video-actions .rewatch-btn {
            padding: 7px 12px;
            font-size: 11px;
        }

        .registration-video-title {
            font-size: 13px;
        }
    }
</style>

@section('content')

    @php

        $register_video = \App\Models\RegisterSetting::First();

        if (!function_exists('convertToEmbed')) {
            function convertToEmbed($url)
            {
                $cleanUrl = preg_replace('/\?.*/', '', $url);
                if (str_contains($cleanUrl, 'youtu.be/')) {
                    $videoId = substr($cleanUrl, strpos($cleanUrl, 'youtu.be/') + 9);
                    return "https://www.youtube-nocookie.com/embed/" . $videoId;
                }
                if (str_contains($cleanUrl, 'watch?v=')) {
                    $videoId = substr($cleanUrl, strpos($cleanUrl, 'watch?v=') + 8);
                    return "https://www.youtube-nocookie.com/embed/" . $videoId;
                }
                if (str_contains($cleanUrl, '/shorts/')) {
                    $videoId = substr($cleanUrl, strpos($cleanUrl, '/shorts/') + 8);
                    return "https://www.youtube-nocookie.com/embed/" . $videoId;
                }
                if (str_contains($cleanUrl, 'embed/')) {
                    return str_replace("youtube.com", "youtube-nocookie.com", $cleanUrl);
                }
                return $url;
            }
        }

        $registrationModalVideoUrl = $registrationModalVideoUrl ?? null;
        $registrationModalVideoUrl = $registrationModalVideoUrl
            ?: '';
        $registrationModalVideoUrl = $registrationModalVideoUrl
            ?: rtrim(config('app.image_domain'), '/') . '/storage/' . $register_video->video;
        $registrationModalVideoUrl = $registrationModalVideoUrl ? convertToEmbed($registrationModalVideoUrl) : null;
        $registrationModalIsMp4 = $registrationModalVideoUrl && preg_match('/\.(mp4|mov)($|\?)/i', $registrationModalVideoUrl);
        $registrationModalVideoSrc = $registrationModalVideoUrl
            ? ($registrationModalIsMp4
                ? $registrationModalVideoUrl
                : ($registrationModalVideoUrl . (str_contains($registrationModalVideoUrl, '?') ? '&' : '?') . 'autoplay=1&mute=1&rel=0'))
            : null;
        $registrationVideoHelpLinkAr = '<a href="#" class="text-decoration-underline registration-video-trigger">اضغط هنا</a>';
        $registrationVideoHelpLinkEn = '<a href="#" class="text-decoration-underline text-black registration-video-trigger">click here</a>';
    @endphp

    @if($registrationModalVideoSrc)
        <div class="modal fade registration-video-modal" id="registrationVideoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="registration-video-header d-flex justify-content-between align-items-center">
                        <p class="registration-video-title">Welcome Video</p>
                        <div class="registration-video-actions d-flex align-items-center">
                            <button type="button" class="rewatch-btn" id="registrationVideoRewatch">Rewatch</button>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="ratio ratio-16x9">
                            @if($registrationModalIsMp4)
                                <video id="registrationVideoPlayer" data-src="{{ $registrationModalVideoSrc }}" controls
                                    playsinline>
                                </video>
                            @else
                                <iframe id="registrationVideoFrame" data-src="{{ $registrationModalVideoSrc }}"
                                    title="Registration Video" allow="autoplay; encrypted-media; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--<div id="videoUploadLoader" class="upload-loader-overlay1" style="display:none;">-->
    <!--    <div class="loader-content1">-->
    <!--        <div class="spinner1"></div>-->
    <!--        <h4 style="font-family:'NowM'; color:#000;">Uploading your video...</h4>-->
    <!--        <p style="font-family:'NowR'; color:#555;">Please wait, this may take a few seconds</p>-->
    <!--    </div>-->
    <!--</div>-->

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="text-start mb-4">
                        <h2 class="headTitle">Real Estate All-Stars <br>Contestant Registration Form</h2>
                        <p class="text-muted" style="font-size:15px;color: #667085">Please enter your details.</p>
                        <h3 class="mt-4" style="font-size:20px;">Personal Information</h3>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4" style="font-family: 'NowR', sans-serif;">
                            <strong class="d-block mb-2">Please fix the following errors:</strong>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php
                        $nationalities = \App\Models\Nationality::get();
                    @endphp


                    <form dir="ltr" id="myForm" action="{{ route('contestant.register') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">

                            {{-- Profile Photo --}}
                            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center">
                                <label class="photo-upload-area" for="profilePhotoInput">

                                    <input type="file" name="profile_photo" id="profilePhotoInput" accept="image/*"
                                        style="display:none;">

                                    <img id="previewImage" alt="Preview">

                                    <div id="cameraIcon" class="camera-icon">
                                        📷
                                    </div>
                                </label>

                                @error('profile_photo')
                                    <div class="text-danger mt-2 text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Full Name --}}
                            <div class="col-md-6">
                                <label class="form-label labelName">Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Enter Full Name"
                                    value="{{ old('full_name') }}" required>
                                @error('full_name') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label labelName">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your Email Address"
                                    value="{{ old('email') }}" required>
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <label class="form-label labelName">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your Phone Number" value="{{ old('phone') }}" maxlength="11"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);" required>
                                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>


                            {{-- Password --}}
                            <div class="col-md-6 position-relative">
                                <label class="form-label labelName">Password</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Enter your Password" required>

                                <span class="toggle-password" data-target="password"
                                    style="position:absolute; top:38px; right:15px; cursor:pointer;">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>

                                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Instagram Link --}}
                            <div class="col-12">
                                <label class="form-label labelName">Instagram Link <span class="text-danger">*</span></label>
                                <input type="url" id="instagramLinkInput" name="social_platforms[instagram]"
                                    class="form-control" placeholder="https://instagram.com/username"
                                    value="{{ old('social_platforms.instagram') }}" required>

                                @error('social_platforms') <div class="text-danger small">{{ $message }}</div> @enderror
                                @error('social_platforms.*') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            <!-- {{-- Intro Video --}}
                            <p class="labelName mt-3">Video Submissions</p>
                            <div class="col-12 d-flex align-items-center">
                                <input type="file" name="intro_video" class="form-control" accept="video/*" required>
                                <label class="input-group-text text-center" style="width: 114px; background-color: #000; border-color: #000; color: #fff;">Upload</label>
                            </div>
                            @error('intro_video') <div class="text-danger small">{{ $message }}</div> @enderror -->

                            {{-- Intro Video --}}
                            <div class="d-flex align-items-center gap-2 mt-3 ">
                                <p class="labelName m-0">Video Submissions</p>
                                <div class="video-upload-status" id="videoUploadStatus">
                                    <span class="video-upload-spinner" aria-hidden="true"></span>
                                    <span class="video-upload-text">Uploading your video, please wait...</span>
                                </div>
                            </div>
                            <p class="text-muted " style="font-size:14px; font-family: 'NowR', sans-serif; color:#000;">
                                <span
                                    class="d-block">{!! trans('sign.video_help_line', ['link' => $registrationVideoHelpLinkEn], 'en') !!}</span>
                            </p>

                            <div class="col-12 d-flex align-items-center">
                                <div class="input-group">
                                    <input type="file" name="intro_video" id="intro_video" class="form-control"
                                        accept="video/*" required>
                                    <label for="intro_video" class="input-group-text upload-btn">Upload</label>
                                </div>
                            </div>

                            @error('intro_video')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror



                            {{-- Additional textareas --}}
                            {{--
                            <div class="col-12 mt-4">
                                <label class="form-label labelName">Why do you want to participate in Real Estate All
                                    stars?</label>
                                <textarea name="participation_reason" class="form-control" rows="2"
                                    required>{{ old('participation_reason') }}</textarea>
                                @error('participation_reason') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label labelName">What makes you a standout real estate sales?</label>
                                <textarea name="standout_reason" class="form-control" rows="2"
                                    required>{{ old('standout_reason') }}</textarea>
                                @error('standout_reason') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            --}}

                            {{-- Terms & Consent --}}
{{--
                            <div class="col-12">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" name="terms" id="confirm" value="1" {{ old('terms') ? 'checked' : '' }} required>
                                    <label class="form-check-label confirmCheck text-muted" for="confirm">
                                        <a href="{{ route('terms.index') }}" class="text-muted text-decoration-underline">I
                                            agree to the terms and conditions of Real Estate All-Stars</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" name="consent" id="confirm2" value="1"
                                        {{ old('consent') ? 'checked' : '' }} required>
                                    <label class="form-check-label confirmCheck text-muted" for="confirm2">I consent to the
                                        use of my personal information and video submissions for the purposes of the
                                        competition</label>
                                </div>
                            </div>
                            --}}

                            {{-- Submit --}}
                            <div class="col-12">
                                <button type="submit" class="btn w-100 py-2 fw-semibold"
                                    style="background:black; color:white; border-radius:6px; font-size:16px;">Submit</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalEl = document.getElementById('registrationVideoModal');
            if (!modalEl || typeof bootstrap === 'undefined') return;

            const frame = document.getElementById('registrationVideoFrame');
            const player = document.getElementById('registrationVideoPlayer');
            const rewatchBtn = document.getElementById('registrationVideoRewatch');
            const src = frame ? frame.getAttribute('data-src') : (player ? player.getAttribute('data-src') : '');
            const modal = new bootstrap.Modal(modalEl);

            modalEl.addEventListener('shown.bs.modal', () => {
                if (frame && src) {
                    frame.src = src;
                    return;
                }
                if (player && src) {
                    player.src = src;
                    player.muted = true;
                    player.currentTime = 0;
                    const playPromise = player.play();
                    if (playPromise && typeof playPromise.catch === 'function') {
                        playPromise.catch(() => { });
                    }
                }
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                if (frame) frame.src = '';
                if (player) {
                    player.pause();
                    player.removeAttribute('src');
                    player.load();
                }
            });

            const playFromStart = () => {
                if (frame && src) {
                    frame.src = src;
                    return;
                }
                if (player) {
                    if (!player.src && src) {
                        player.src = src;
                    }
                    player.currentTime = 0;
                    const playPromise = player.play();
                    if (playPromise && typeof playPromise.catch === 'function') {
                        playPromise.catch(() => { });
                    }
                }
            };

            if (rewatchBtn) {
                rewatchBtn.addEventListener('click', playFromStart);
            }

            document.querySelectorAll('.registration-video-trigger').forEach((trigger) => {
                trigger.addEventListener('click', (event) => {
                    event.preventDefault();
                    if (modalEl.classList.contains('show')) {
                        playFromStart();
                        return;
                    }
                    modal.show();
                });
            });

            modal.show();
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById('myForm');
            const videoInput = form.querySelector('input[name="intro_video"]');
            const status = document.getElementById('videoUploadStatus');
            const instagramInput = document.getElementById('instagramLinkInput');

            form.addEventListener('submit', function (e) {
                // Instagram validation
                if (!instagramInput || !instagramInput.value.trim()) {
                    e.preventDefault();
                    alert('Please enter your Instagram link before submitting.');
                    if (instagramInput) instagramInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }
                try {
                    new URL(instagramInput.value.trim());
                } catch (error) {
                    e.preventDefault();
                    alert('Please enter a valid Instagram URL (include https://).');
                    instagramInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                // Profile Photo Validation
                const profilePhotoInput = document.getElementById('profilePhotoInput');
                if (profilePhotoInput.files.length === 0) {
                     e.preventDefault();
                     alert('Please upload a profile photo before submitting.');
                     const photoArea = document.querySelector('.photo-upload-area');
                     if(photoArea) photoArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                     return;
                }

                // تأكد أن المستخدم فعلاً اختار فيديو وابدأ الرفع
                if (videoInput.files.length > 0 && status) {
                    status.classList.add('is-active');
                }
            });
        });
    </script>

    <!--
    <script>
        // Regions/Countries display logic
        document.addEventListener("DOMContentLoaded", () => {


            // Social platforms
            const addBtn = document.getElementById('addPlatformBtn');
            const platformSelect = document.getElementById('platformSelect');
            const platformLinkInput = document.getElementById('platformLinkInput');
            const addedContainer = document.getElementById('addedPlatforms');

            if (!addBtn || !platformSelect || !platformLinkInput || !addedContainer) return;

            addBtn.addEventListener('click', function () {
                const platform = platformSelect.value;
                const link = platformLinkInput.value.trim();

                if (!platform) return alert('Please choose a platform.');
                if (!link) return alert('Please enter a link (must be a valid URL).');

                try { new URL(link); } catch (e) { return alert('Please enter a valid URL (include https://).'); }

                const existing = addedContainer.querySelector(`.platform-row[data-platform="${platform}"]`);
                if (existing) {
                    existing.querySelector('input[type="hidden"]').value = link;
                    existing.querySelector('a').href = link;
                    existing.querySelector('a').textContent = link;
                } else {
                    const row = document.createElement('div');
                    row.className = 'd-flex align-items-center mb-2 platform-row';
                    row.setAttribute('data-platform', platform);

                    row.innerHTML = `
                    <input type="hidden" name="social_platforms[${platform}]" value="${link}">
                    <strong class="me-2 text-capitalize">${platform}:</strong>
                    <a href="${link}" target="_blank" class="me-3 small text-decoration-underline">${link}</a>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-platform-btn ms-auto">Remove</button>
                `;
                    addedContainer.appendChild(row);
                }

                platformLinkInput.value = '';
                platformSelect.value = '';
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-platform-btn')) {
                    const row = e.target.closest('.platform-row');
                    if (row) row.remove();
                }
            });
        });
    </script>
    -->



    <!--
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otherCheckbox = document.getElementById('Other');
            const otherInputWrapper = document.getElementById('other_expertise_wrapper');
            if (!otherCheckbox || !otherInputWrapper) return;

            function toggleOtherInput() {
                if (otherCheckbox.checked) {
                    otherInputWrapper.style.display = 'block';
                } else {
                    otherInputWrapper.style.display = 'none';
                    otherInputWrapper.querySelector('input').value = '';
                }
            }

            // Run on page load (for old values)
            toggleOtherInput();

            // Run when checkbox changes
            otherCheckbox.addEventListener('change', toggleOtherInput);
        });
    </script>
    -->

    <script>
        document.getElementById('profilePhotoInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('previewImage');
            const cameraIcon = document.getElementById('cameraIcon');

            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewImage.style.display = "block";
                cameraIcon.style.display = "none";
            }
        });
    </script>

    <!--
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const destinationSelect = document.getElementById('destinationSelect');
        const regionsBlock = document.getElementById('regionsBlock');
        const countriesBlock = document.getElementById('countriesBlock');

        function toggleBlocks() {
            const selected = destinationSelect.value;

            regionsBlock.style.display = selected === 'Egypt' ? 'block' : 'none';
            countriesBlock.style.display = selected === 'OtherCountries' ? 'block' : 'none';
        }

        destinationSelect.addEventListener('change', toggleBlocks);

        // Run on load to keep old selections visible
        toggleBlocks();
    });
    </script> -->

    <!--
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {

                const inputId = this.getAttribute('data-target');
                const input = document.getElementById(inputId);
                const i = this.querySelector('i');

                if (input.type === "password") {
                    input.type = "text";
                    i.classList.remove("fa-eye-slash");
                    i.classList.add("fa-eye");
                } else {
                    input.type = "password";
                    i.classList.remove("fa-eye");
                    i.classList.add("fa-eye-slash");
                }
            });
        });
    </script>
    -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.querySelector('input[name="email"]');
            const phoneInput = document.querySelector('input[name="phone"]');

            // عناصر عرض رسائل الخطأ
            const emailMsg = document.createElement('small');
            const phoneMsg = document.createElement('small');

            emailMsg.style.color = 'red';
            phoneMsg.style.color = 'red';

            // إضافتهم بعد الحقول
            emailInput.insertAdjacentElement('afterend', emailMsg);
            phoneInput.insertAdjacentElement('afterend', phoneMsg);

            let emailTimer, phoneTimer;

            // دالة التحقق من وجود المستخدم
            function checkExists(field, value) {
                return fetch("{{ route('check.user.exists') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ [field]: value })
                }).then(res => res.json());
            }

            // ✅ تحقق البريد الإلكتروني أثناء الكتابة
            emailInput.addEventListener('input', function () {
                clearTimeout(emailTimer);
                const value = this.value.trim();
                emailMsg.textContent = ''; // امسح الرسالة القديمة

                if (!value) return;

                emailTimer = setTimeout(() => {
                    checkExists('email', value).then(data => {
                        if (data.email_exists) {
                            emailMsg.textContent = 'This email address is already in use.';
                            emailInput.classList.add('border-danger');
                        } else {
                            emailMsg.textContent = '';
                            emailInput.classList.remove('border-danger');
                        }
                    });
                }, 500); // تأخير بسيط لتجنب كثرة الطلبات
            });

            // ✅ تحقق رقم الهاتف أثناء الكتابة
            phoneInput.addEventListener('input', function () {
                clearTimeout(phoneTimer);
                const value = this.value.trim();
                phoneMsg.textContent = '';

                if (!value) return;

                phoneTimer = setTimeout(() => {
                    checkExists('phone', value).then(data => {
                        if (data.phone_exists) {
                            phoneMsg.textContent = 'This phone number is already in use.';
                            phoneInput.classList.add('border-danger');
                        } else {
                            phoneMsg.textContent = '';
                            phoneInput.classList.remove('border-danger');
                        }
                    });
                }, 500);
            });
        });
    </script>


    <!--
    {{-- ✅ Select2 Library --}}
    <script>
        $(document).ready(function () {
            // Initialize all select2
            $('.select2').select2({
                width: '100%',
                placeholder: 'Select options',
                allowClear: true
            });

            const $destinationSelect = $('#destinationSelect');
            const $regionsBlock = $('#regionsBlock');
            const $countriesBlock = $('#countriesBlock');
            const $regionsSelect = $('#regionsBlock select[name="regions[]"]');
            const $countriesSelect = $('#countriesBlock select[name="countries[]"]');
            const $countriesOtherWrapper = $('#countriesOtherWrapper');
            const $countriesOtherInput = $('#countriesOtherWrapper textarea[name="countries_other"]');
            const $destinationPayload = $('#destinationPayload');

            function updateDestinationPayload() {
                const selectedDestinations = $destinationSelect.val() || [];
                const payload = {};

                if (selectedDestinations.includes('Egypt')) {
                    payload.Egypt = $regionsSelect.val() || [];
                }
                if (selectedDestinations.includes('OtherCountries')) {
                    const countriesSelected = $countriesSelect.val() || [];
                    const otherText = ($countriesOtherInput.val() || '')
                        .split(',')
                        .map((item) => item.trim())
                        .filter((item) => item.length > 0);

                    payload.OtherCountries = countriesSelected
                        .filter((item) => item !== 'Others')
                        .concat(otherText);
                }

                $destinationPayload.val(JSON.stringify(payload));
            }

            function toggleBlocks() {
                const selected = $destinationSelect.val() || [];
                $regionsBlock.toggle(selected.includes('Egypt'));
                $countriesBlock.toggle(selected.includes('OtherCountries'));

                const countriesSelected = $countriesSelect.val() || [];
                $countriesOtherWrapper.toggle(countriesSelected.includes('Others'));
                if (!countriesSelected.includes('Others')) {
                    $countriesOtherWrapper.find('textarea').val('');
                }

                updateDestinationPayload();
            }

            // Initialize Select2 for Destination
            $destinationSelect.select2({
                width: '100%',
                placeholder: 'Select Country(ies)',
                allowClear: true
            }).on('change', toggleBlocks);

            $regionsSelect.on('change', toggleBlocks);
            $countriesSelect.on('change', toggleBlocks);
            $countriesOtherInput.on('input', updateDestinationPayload);

            // Run once on page load
            toggleBlocks();
        });
    </script>
    -->



    <!--
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm-password');
            const errorMsg = document.getElementById('passwordError');
            if (!passwordInput || !confirmInput || !errorMsg) return;

            function validatePasswordMatch() {
                const password = passwordInput.value;
                const confirm = confirmInput.value;

                if (confirm.length > 0 && password !== confirm) {
                    errorMsg.textContent = 'Passwords do not match';
                } else {
                    errorMsg.textContent = '';
                }
            }

            passwordInput.addEventListener('input', validatePasswordMatch);
            confirmInput.addEventListener('input', validatePasswordMatch);
        });
    </script>
    -->

@endpush
