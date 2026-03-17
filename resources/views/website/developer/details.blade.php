<section>
    <div class="container">
        <div class="row g-3 align-items-stretch project-gallery">

             <!-- العمود الأول: الصورة الكبيرة -->
                <div class="col-12 col-md-6 d-flex">
                <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $project->main_photo }}"
                     class="big-img flex-fill"
                     alt="Large Image">
            </div>
        
            <!-- العمود الثاني: 2 فوق و1 تحت -->
            {{-- @php
                $photos = $project->photos ?? [];
                $photos = array_slice($photos, 0, 3);
            @endphp --}}
        
            <div class="col-12 col-md-6 d-flex flex-column">
                <div class="right-images flex-fill">
                    <div class="right-top">
                        
                            <div class="right-item">
                                <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $project->photo_1  }}"
                                     class="small-img"
                                     alt="Small Image 1">
                            </div>
                        
                            <div class="right-item">
                                <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $project->photo_2 }}"
                                     class="small-img"
                                     alt="Small Image 2">
                            </div>
                        
                    </div>
        
                   
                        <div class="right-bottom">
                            <img src="{{ env('IMAGE_DOMAIN') . '/storage/' . $project->photo_3 }}"
                                 class="small-img"
                                 alt="Bottom Image">
                        </div>
                    
                </div>
            </div>


        </div>
    </div>
</section>

<section class="py-4 bg-white mt-4">
    <div class="container">
        <div class="row g-5 align-items-start ">

            <!-- العمود الشمال (العنوان + collapse) -->
            <div class="col-md-8 order-1 order-md-1 alldiv">
                <h2 class="mb-3 fw-semibold title">{{ app()->getLocale() === 'ar' ? $project->name_ar : $project->name_en }}</h2>

                <!-- Collapse 1 -->
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 subtitle">{{ __('developer.overview') }}</p>
                        <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#overview"
                                aria-expanded="false"
                                aria-controls="overview">+</button>
                    </div>
                    <div class="collapse mt-2" id="overview">
                        {{-- <ul class="text-all">
                            <li>This beautifully priced home offers a fantastic value for a serene and spacious living environment in the desirable Zen Abode community.</li>
                            <li>Designed for families or individuals who appreciate privacy and personal space, this single-family home stands out with its modern architectural style and thoughtful design.</li>
                            <li>Currently available for purchase, providing an excellent opportunity for buyers looking for a new home in a tranquil suburban setting.</li>
                            <li>This beautifully priced home offers a fantastic value for a serene and spacious living environment in the desirable Zen Abode community.</li>
                        </ul> --}}
                        
                        <p class="text-all">
                                 {!! nl2br(e(app()->getLocale() === 'ar' ? $project->overview_ar : $project->overview_en)) !!}
                             </p>
                    </div>
                </div>

                <!-- Collapse 2 -->
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 subtitle">{{ __('developer.interior_details') }}</p>
                        <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#interior"
                                aria-expanded="false"
                                aria-controls="interior">+</button>
                    </div>
                    <div class="collapse mt-2" id="interior">
                       {{-- <ul class="text-all">
                            <li>This beautifully priced home offers a fantastic value for a serene and spacious living environment in the desirable Zen Abode community.</li>
                            <li>Designed for families or individuals who appreciate privacy and personal space, this single-family home stands out with its modern architectural style and thoughtful design.</li>

                        </ul> --}}
                        
                        <p class="text-all"> {!! 
                        nl2br(e(app()->getLocale() === 'ar' ? $project->interior_details_ar : $project->interior_details_en ))
                        !!}</p>

                    </div>
                </div>
            </div>

            <!-- العمود اليمين (الأزرار) -->
           <div class="col-md-3 order-2 order-md-2 d-flex flex-column justify-content-center gap-2 btns">
            <a href="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $project->master_plan}}" target="_blank"  class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                <img src="{{asset('public/images/developer/details/Vector.png')}}" alt=""> {{ __('developer.master_plan') }}
            </a>
            <a href="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $project->brochure}}" target="_blank"  class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                <img src="{{asset('public/images/developer/details/brochure.png')}}" alt=""> {{ __('developer.brochure') }}
            </a>
            <a href="{{ $project->map_url ? $project->map_url : '#' }}" target="_blank" class="btn btn-outline-dark btnsRight d-flex align-items-center justify-content-start gap-2">
                <img src="{{asset('public/images/developer/details/maps (1).png')}}" alt=""> {{ __('developer.view_in_map') }}
            </a>
            
            <a class="btn btn-light btnsRight btncolor">{{ __('developer.interested') }}</a>
        </div>


        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle-btn');
        toggles.forEach(btn => {
            const target = document.querySelector(btn.getAttribute('data-bs-target'));
            target.addEventListener('shown.bs.collapse', () => btn.textContent = '-');
            target.addEventListener('hidden.bs.collapse', () => btn.textContent = '+');
        });
    });
</script>

<style>

    .alldiv{
        margin-left: 50px;
    }

    @media (max-width: 768px) {
        .alldiv{
            margin-left: 0px;
        }
    }

    .toggle-btn {
        color: #000 !important;  /* أسود */
        font-weight: bold;       /* لو عاوزها تخينة */
    }
    .btns{
        margin-top: 120px;
    }

    .border-bottom {
        border-bottom: 1px solid #000 !important; /* غلّظ الخط */
    }
    @media (max-width: 768px) {
        .btns{
            margin-top: 40px;
        }
    }
    .project-gallery {
        --gallery-height: auto;
        --gallery-gap: 16px;
    }

    @media (min-width: 768px) {
        .project-gallery {
            --gallery-height: 620px;
        }
    }

    .title{
        font-size: 26px;
        font-weight: 600;
    }

    .subtitle{
        font-family: 'NowM', sans-serif;
        font-size: 20px;
    }

    .text-all{
        font-family: 'NowR', sans-serif;
        font-size: 14px;
        line-height: 24px;
    }


    .btnsRight{
        width: 171px;
        height: 56px;
        background-color: #000000;
        color: #ffffff;
        border-radius: 16px;
        padding-top: 16px;
        padding-bottom: 16px;
        padding-left: 24px;
        padding-right:24px
        text-align: center;
        font-family: 'NowR', sans-serif;
        font-size: 16px;
        font-weight: 500;
    }
    .btncolor{
        color: #000000;
        background: linear-gradient(90deg, #C79720, #F8DA58);
    }

    @media (max-width: 768px) {
        .btnsRight{
          width: 100%;
        }
    }
    
    
/* الصف الأساسي يخلي العمودين بنفس الطول */
        .row.align-items-stretch > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .right-images {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: var(--gallery-gap);
            height: var(--gallery-height);
        }

        .right-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--gallery-gap);
        }

        .right-item,
        .right-bottom {
            min-height: 0;
        }
        
        /* الصورة الكبيرة تملى العمود بالكامل */
        .big-img {
            width: 100%;
            height: var(--gallery-height);
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            flex-grow: 1;
        }
        
        /* الصور الصغيرة */
        .small-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            display: block;
        }
        
        /* الموبايل */
        @media (max-width: 767px) {
            .project-gallery {
                --gallery-gap: 12px;
            }

            .right-images {
                height: auto;
                grid-template-rows: auto auto;
                flex: 0 0 auto;
            }

            .big-img,
            .small-img {
                height: auto !important;
            }
        }




</style>
