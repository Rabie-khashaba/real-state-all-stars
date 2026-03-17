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
        .nav-tabs {
            padding-left: 0;     /* إزالة البادئة الداخلية */
            margin-left: 0;
            border-bottom: 2px solid #000; /* سمك ولون الخط */

        }

        .nav-tabs .nav-link {
        padding-left: 0.5rem;  /* قلل البادئة الداخلية حسب الرغبة */
        padding-right: 0.5rem;
        text-align: left;      /* اجعل النص يبدأ من اليسار */
        border: none;
        background: none;
        color: #667085;
         font-family: 'NowR', sans-serif;
        font-size: 16px;
        }

         @media (max-width: 767.98px) {
         .nav-tabs .nav-link{
            font-size: 12px;
        }
        }


       .nav-tabs .nav-link.active {
        color: #000 !important; /* لون مميز عند التحديد */
        background-color: #f8f9fa !important;
        font-family: 'NowR', sans-serif;
        font-size: 16px;
        }
        .subtitle{
            font-family: 'NowM', sans-serif;
            font-size: 18px;
        }

         @media (max-width: 767.98px) {
         .subtitle{
            font-size: 15px;
        }
        }

        .para{
            font-family: 'NowM', sans-serif;
            font-size: 16px;
            line-height: 24px;
            color: #667085;
             margin-left: 0;    /* إزالة أي هامش أيسر */
            padding-left: 0;   /* إزالة أي حشوة يسار */
        }

        .para-rtl {
            direction: rtl;
            text-align: right;
        }

        .para-ltr {
            direction: ltr;
            text-align: left;
        }

        .subtitle-rtl {
            direction: rtl;
            text-align: right;
        }

        .subtitle-ltr {
            direction: ltr;
            text-align: left;
        }

        .toggle-btn {
            color: #000; /* غيّر اللون هنا لأي لون تحبه */
        }



        /* اختياري: تعديل المسافة حسب حجم الشاشة */
        @media (max-width: 767.98px) {
        .collapse {
            padding-left: 0;
        }
        }

        .content{
            max-width: 800px;
        }
        .title{
            font-family: 'NowM', sans-serif;
            font-size: 35px;
        }
        .para2{
            font-family: 'NowM', sans-serif;
            font-size: 20px;
            line-height: 30px;
            color: #667085;
        }

</style>



@endsection

@section('content')

<section class="container py-5">
    <div class="content justify-content-star">
        <h2 class="title">
            {{ $locale === 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions' }}
        </h2>
        <p class="para2">
            {{ $locale === 'ar'
                ? 'لديك أسئلة؟ لدينا إجابات. استكشف الاستفسارات الأكثر شيوعًا حول ما هي نجوم العقارات؟'
                : 'Got questions? We\'ve got answers. Explore the most common queries about What is Real Estate All-Stars?' }}
        </p>
    </div>
</section>


<section style="margin-bottom: 200px;" class="py-5 bg-light">
  <div class="container">

    <!-- Tabs (بداية التبويبات) -->
    @if($types && $types->count() > 0)
    <ul class="nav nav-tabs custom-tabs justify-content-start mb-4" id="myTab" role="tablist">
        @foreach($types as $index => $type)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $index === 0 ? 'active' : '' }}"
               id="tab{{ $index + 1 }}-tab"
               data-bs-toggle="tab"
               href="#tab{{ $index + 1 }}"
               role="tab"
               aria-controls="tab{{ $index + 1 }}"
               aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ __('faq.' . $type) }}</a>
        </li>
        @endforeach
    </ul>

    <!-- المحتوى لكل Tab -->
    <div class="tab-content" id="myTabContent">
        @foreach($types as $index => $type)
        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
             id="tab{{ $index + 1 }}"
             role="tabpanel"
             aria-labelledby="tab{{ $index + 1 }}-tab">
            @if(isset($faqsByType[$type]))
                @foreach($faqsByType[$type] as $faqIndex => $faq)
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 subtitle {{ $locale === 'ar' ? 'subtitle-rtl' : 'subtitle-ltr' }}">
                            {{ $locale === 'ar' ? ($faq->question_ar ?? '') : ($faq->question_en ?? '') }}
                        </p>
                        <button class="btn btn-link p-0 fs-4 text-decoration-none toggle-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}{{ $faqIndex }}"
                                aria-expanded="false"
                                aria-controls="collapse{{ $index }}{{ $faqIndex }}">></button>
                    </div>
                    <div class="collapse mt-2" id="collapse{{ $index }}{{ $faqIndex }}" data-bs-parent=".tab-content">
                        <p class="para {{ $locale === 'ar' ? 'para-rtl' : 'para-ltr' }}">
                            {!! $locale === 'ar' ? ($faq->answer_ar ?? '') : ($faq->answer_en ?? '') !!}
                        </p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">
        <p class="para">{{ $locale === 'ar' ? 'لا توجد أسئلة متاحة.' : 'No FAQs available.' }}</p>
    </div>
    @endif

  </div>
</section>




@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-btn');
    const allCollapses = document.querySelectorAll('.collapse');

    toggles.forEach(btn => {
      const targetId = btn.getAttribute('data-bs-target');
      const target = document.querySelector(targetId);

      // عند فتح سؤال جديد، إغلاق جميع الأسئلة الأخرى
      target.addEventListener('show.bs.collapse', function () {
        allCollapses.forEach(collapse => {
          if (collapse.id !== targetId.replace('#', '')) {
            const bsCollapse = bootstrap.Collapse.getInstance(collapse);
            if (bsCollapse && collapse.classList.contains('show')) {
              bsCollapse.hide();
            }
          }
        });
      });

      // تغيير الأيقونة عند الفتح والإغلاق
      target.addEventListener('shown.bs.collapse', () => btn.textContent = '-');
      target.addEventListener('hidden.bs.collapse', () => btn.textContent = '>');
    });
  });
</script>

