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




    .main-article {
      max-width: 800px;
      margin: 10px auto;
      padding: 3rem 2.5rem;
    }

    .main-article img {
        width: 100%;
        border-radius: 10px;
        object-fit: cover;
        }

     .icon-box {
      border: 1px solid #d0d5dd;
      border-radius: 12px;
      padding: 8px 12px;
      background-color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    
    .icon-box:hover {
      background-color: #f9fafb;
    }
    
    .icon-img {
      font-size: 16px;
      color: #344054;
    }
    
    .icon-text {
      font-size: 14px;
      color: #344054;
      font-weight: 500;
    }



    .badge-tag {
        background: #FFFFFF;
        color: #344054;
        font-size: 14px;
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 500;
        font-family: "NowR", sans-serif;
        border: 1px solid #D0D5DD;
         display: inline-block;
    }
    .headTitle{
        font-size: 33px;
         font-family: "NowM", sans-serif;
         font-weight: 500;
         margin-top: 20px;
    }
     @media (max-width: 768px) {
            .headTitle{
                font-size: 20px;
            }
        }

    .history{
        font-family: "NowM", sans-serif;
        font-size: 18px;
        line-height: 28px;
    }
    .sub-titleHead{
         font-family: "NowM", sans-serif;
         font-size: 36px;
        font-weight: 500;
        margin-top: 30px;
    }
    .para{
         font-family: "NowM", sans-serif;
         font-size: 20px;
         line-height: 25px;
         color: #667085;
         margin-bottom: 50px;
    }

    .titleHead2{
        font-family: "NowM", sans-serif;
        font-size: 50px;
        margin-top: 10px;
    }

    .news-content-rtl {
        direction: rtl;
        text-align: right;
    }

    .news-content-ltr {
        direction: ltr;
        text-align: left;
    }
    
     .badge-rtl {
        direction: rtl;
        text-align: right;
    }

    .badge-ltr {
        direction: ltr;
        text-align: left;
    }

    .title-rtl {
        direction: rtl;
        text-align: right;
    }

    .title-ltr {
        direction: ltr;
        text-align: left;
    }

    .date-info-rtl {
        direction: rtl;
        text-align: right;
    }

    .date-info-ltr {
        direction: ltr;
        text-align: left;
    }

    .news-content h4,
    .news-content .sub-titleHead,
    .news-content .sub-titleHead2 {
        font-family: "NowM", sans-serif;
        font-size: 36px;
        font-weight: 500;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .news-content p,
    .news-content .para {
        font-family: "NowM", sans-serif;
        font-size: 20px;
        line-height: 25px;
        color: #667085;
        margin-bottom: 50px;
    }



  </style>

@endsection

@section('content')


  <main class="main-article text-center text-lg-start py-5">
    @if($news)
        <div class="{{ $locale === 'ar' ? 'badge-rtl' : 'badge-ltr' }}" style="display: block; margin-bottom: 10px;">
            <span class="badge-tag">
                {{ $news->category ? ($locale === 'ar' ? $news->category->name_ar : $news->category->name_en) : '' }}
            </span>
        </div>
        <h2 class="headTitle mb-4 {{ $locale === 'ar' ? 'title-rtl' : 'title-ltr' }}">
            {{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}
        </h2>

        @if($news->image_path)
        <img src="{{ rtrim(config('app.image_domain'), '/') . '/storage/' . $news->image_path }}"
             alt="{{ $locale === 'ar' ? ($news->title_ar ?? '') : ($news->title_en ?? '') }}"
             class="mb-4">
        
        @endif

        <div class="published-row d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

            <!-- تاريخ النشر -->
            <div class="{{ $locale === 'ar' ? 'date-info-rtl' : 'date-info-ltr' }}">
                <p class="text-muted small mb-0">{{ $locale === 'ar' ? 'تاريخ النشر' : 'Published on' }}</p>
                <p class="history mb-0">
                    {{ $news->date ? \Carbon\Carbon::parse($news->date)->format('M d, Y') : '' }}
                </p>
            </div>

            <!-- الأيقونات -->
            <div class="social-icons d-flex align-items-center gap-2">
                <div class="icon-box d-flex align-items-center gap-2" onclick="copyLink()">
                    <i class="fa-solid fa-link icon-img"></i>
                    <span class="icon-text">{{ $locale === 'ar' ? 'نسخ الرابط' : 'Copy link' }}</span>
                </div>

                <!-- Twitter -->
                <div class="icon-box" onclick="shareOnTwitter()">
                    <i class="fab fa-twitter icon-img"></i>
                </div>

                <!-- Facebook -->
                <div class="icon-box" onclick="shareOnFacebook()">
                    <i class="fab fa-facebook-f icon-img"></i>
                </div>

                <!-- LinkedIn -->
                <div class="icon-box" onclick="shareOnLinkedIn()">
                    <i class="fab fa-linkedin-in icon-img"></i>
                </div>
            </div>
        </div>

        <!-- عرض المحتوى من content_ar أو content_en -->
        @if($content)
        <div class="news-content {{ $locale === 'ar' ? 'news-content-rtl' : 'news-content-ltr' }}">
            {!! $content !!}
        </div>
        @else
        <div class="alert alert-info">
            <p class="para">{{ $locale === 'ar' ? 'لا يوجد محتوى متاح.' : 'No content available.' }}</p>
        </div>
        @endif
    @else
        <div class="alert alert-danger">
            <p class="para">{{ $locale === 'ar' ? 'الخبر غير موجود.' : 'News not found.' }}</p>
        </div>
    @endif
  </main>

  <script>
    function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('{{ $locale === "ar" ? "تم نسخ الرابط" : "Link copied" }}');
        });
    }

    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('{{ $locale === "ar" ? ($news->title_ar ?? "") : ($news->title_en ?? "") }}');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
    }

    function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    }

    function shareOnLinkedIn() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
    }
  </script>

@endsection
