@extends('website.layouts.master')

@section('title', 'Rankings')

@section('styles')
    <style>
        @font-face {
            font-family: 'NowR';
            src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';
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

        .nav-pills .nav-link.active {
            color: #ffffff !important;
            background-color: #000000 !important;
            border: none;
        }

        .nav-pills .nav-link {
            color: black !important;
            background-color: #D9D9D9 !important;
            border: none;
            height: 44px;
            font-family: 'NowM', sans-serif;
            font-size: 18px;
            border-radius: 12px;
            width: 209px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .nav-pills .nav-link {
                width: 100px;
                font-size: 12px;
            }

            /*.tab-text {*/
            /*    visibility: hidden;*/
            /*    position: relative;*/
            /*}*/

            /*.tab-text::before {*/
                
            /*    visibility: visible;*/
            /*    position: absolute;*/
            /*    left: 0;*/
            /*    right: 0;*/
            /*    text-align: center;*/
            /*}*/
        }

        .custom-gap-tabs {
            gap: 60px;
        }

        @media (max-width: 768px) {
            .custom-gap-tabs {
                gap: 16px;
            }
        }

        .description {
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            line-height: 30px;
        }

        @media (max-width: 576px) {
            .description {
                font-size: 12px;
                line-height: 18px;
            }
        }

        .ranking-hero {
/*             background: #1a1a1a;*/
            background: url("{{ asset('public/images/home/ranking.png') }}") center center/cover no-repeat;
            padding: 130px 0 60px 0;
            position: relative;
        }


        .ranking-description {
            font-family: 'NowR', sans-serif;
            font-size: 32px;
            line-height: 1.6;
            color: #ffffff;
            text-align: center;

        }

        .ranking-tabs-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .ranking-hero {
                padding: 60px 0 40px 0;
            }

            .ranking-description {
                font-size: 13px;
                margin-top: 60px;
                margin-bottom: 30px;
            }

            .ranking-tabs-container {
                margin-top: 30px;
            }
        }

        @media (max-width: 576px) {
            .ranking-description {
                font-size: 13px;
                line-height: 1.5;
                margin-bottom: 25px;
            }
        }

        /* Accordion text styling */
        .accordion-body {
            font-family: 'NowR', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #222;
        }
        .accordion-body strong,
        .accordion-body b {
            font-family: 'NowB', sans-serif;
            font-size: 17px;
            color: #000;
        }

        /* Section titles underline */
        .section-title {
            display: inline-block;

            padding-bottom: 6px;
        }

        /* RTL accordion: text starts right, arrow stays on the left */
        [dir="rtl"] .accordion-button {
            flex-direction: row;
            justify-content: flex-start;
            text-align: right;
        }
        [dir="rtl"] .accordion-button::after {
            margin-left: 0;
            margin-right: auto;
        }

        /* Remove default Bootstrap focus shadow on accordion headers */
        .accordion-button:focus {
            box-shadow: none;
            outline: none;
        }

        /* Force accordion header background to white (default Bootstrap uses light blue) */
        .accordion-button,
        .accordion-button:not(.collapsed) {
            background-color: #ffffff !important;
            color: #000;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section with Description -->
    <section class="ranking-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <p class="ranking-description">
                        {{ __('ranking.classification_description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Tabs nav -->
            <div class="row justify-content-center">
                <div class="col-auto">
                    <ul class="nav nav-pills d-flex justify-content-center custom-gap-tabs custom-tabs mb-4" id="rankingTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="individual-tab" data-bs-toggle="pill" data-bs-target="#individual" type="button" role="tab" aria-controls="individual" aria-selected="true">
                                <span class="tab-text">{{ __('ranking.individual') }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="entrepreneur-tab" data-bs-toggle="pill" data-bs-target="#entrepreneur" type="button" role="tab" aria-controls="entrepreneur" aria-selected="false">
                                {{ __('ranking.corporate') }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tabs content -->
            <div class="tab-content" id="rankingTabsContent">
                <!-- Individual Tab -->
                <div class="tab-pane fade show active" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                    <div class="container py-5">
                        <h1 class="mb-4 section-title">{{ __('ranking.individual_rankings') }}</h1>

                        <div class="accordion accordion-flush" id="accordionIndividual">
                            @php
                                $individualItems = [
                                    __('ranking.salespeople_title') => __('ranking.salespeople_desc'),
                                    __('ranking.broker_title') => __('ranking.broker_desc'),
                                    __('ranking.ceo`s_title') => __('ranking.ceo`s_desc'),
                                    __('ranking.entrepreneur_title') => ''
                                ];
                            @endphp

                            @foreach($individualItems as $title => $desc)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ Str::slug($title, '-') }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($title, '-') }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse-{{ Str::slug($title, '-') }}">
                                            {{ $title }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ Str::slug($title, '-') }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading-{{ Str::slug($title, '-') }}" data-bs-parent="#accordionIndividual">
                                        <div class="accordion-body">
                                            {!! $desc !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Entrepreneur Tab -->
                <div class="tab-pane fade" id="entrepreneur" role="tabpanel" aria-labelledby="entrepreneur-tab">
                    <div class="container py-5">
                        <h1 class="mb-4 section-title">{{ __('ranking.entrepreneur_rankings') }}</h1>

                        <div class="accordion accordion-flush" id="accordionEntrepreneur">
                            @php
                                $entrepreneurItems = [
                                    __('ranking.developer_title') => __('ranking.developer_desc'),
                                    __('ranking.brokerage_title') => __('ranking.brokerage_desc'),
                                    __('ranking.construction_title') => __('ranking.construction_desc'),
                                    __('ranking.mortgage_title') => __('ranking.mortgage_desc'),
                                    __('ranking.architecture_title') => __('ranking.architecture_desc'),
                                    __('ranking.management_operation_title') => __('ranking.management_operation_desc'),
                                    __('ranking.proptech_title') => __('ranking.proptech_desc'),
                                ];
                            @endphp

                            @foreach($entrepreneurItems as $title => $desc)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-ent-{{ Str::slug($title, '-') }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ent-{{ Str::slug($title, '-') }}" aria-expanded="false" aria-controls="collapse-ent-{{ Str::slug($title, '-') }}">
                                            {{ $title }}
                                        </button>
                                    </h2>
                                    <div id="collapse-ent-{{ Str::slug($title, '-') }}" class="accordion-collapse collapse" aria-labelledby="heading-ent-{{ Str::slug($title, '-') }}" data-bs-parent="#accordionEntrepreneur">
                                        <div class="accordion-body">
                                            {!! $desc !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
