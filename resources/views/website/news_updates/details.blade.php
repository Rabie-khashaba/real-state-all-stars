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
      margin: 40px auto;
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



  </style>

@endsection

@section('content')


  <main class="main-article text-center text-lg-start">
    <span class="badge-tag">Media Coverage</span>
    <h2 class="headTitle mb-4">How AI is Revolutionizing Customer Success</h2>

    <img src="{{ asset('public/images/news/frame4.png') }}"
         alt="AI" class="mb-4">

<div class="published-row d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

  <!-- تاريخ النشر -->
  <div>
  <p class="text-muted small mb-0">Published on</p>
  <p class="history mb-0">Oct 15, 2024</p>
</div>

<!-- الأيقونات -->
<div class="social-icons d-flex align-items-center gap-2">

 <div class="icon-box d-flex align-items-center gap-2">
  <i class="fa-solid fa-link icon-img"></i>
  <span class="icon-text">Copy link</span>
</div>


  <!-- Twitter -->
  <div class="icon-box">
    <i class="fab fa-twitter icon-img"></i>
  </div>

  <!-- Facebook -->
  <div class="icon-box">
    <i class="fab fa-facebook-f icon-img"></i>
  </div>

  <!-- LinkedIn -->
  <div class="icon-box">
    <i class="fab fa-linkedin-in icon-img"></i>
  </div>
</div>


</div>


    <h4 class="sub-titleHead mb-3">Introduction</h4>
    <p  class="text-secondary fs-6 para">
      In the age of data-driven decision-making, businesses are turning to artificial intelligence (AI)
      to solve one of their biggest challenges: customer retention. According to a recent study by McKinsey,
      companies that leverage AI in customer success see a 20% increase in customer satisfaction and a 15%
      reduction in churn. But how exactly is AI transforming this critical aspect of business? Let’s explore.
    </p>


    <h4 class="sub-titleHead2 mb-3">Predictive Analytics: The Crystal Ball of Customer Success</h4>
    <p  class="text-secondary fs-6 para">
     Imagine being able to identify at-risk customers before they even consider leaving. That’s the power of predictive analytics, a capability made possible by AI. By analyzing vast amounts of customer data—such as usage patterns,
     engagement metrics, and payment history—AI can forecast churn risks with remarkable accuracy.
    </p>


    <h4 class="sub-titleHead2 mb-3">Streamlining Workflows with AI-Powered Automation</h4>
    <p  class="text-secondary fs-6 para">
      For customer success teams, time is a precious commodity. AI-powered automation is helping these teams reclaim hours previously spent on repetitive tasks like onboarding, follow-ups, and renewals.
    Automated playbooks, for instance, guide teams through standardized processes, ensuring consistency and efficiency.
    </p>

    <h4 class="sub-titleHead2 mb-3">Streamlining Workflows with AI-Powered Automation</h4>
    <p  class="text-secondary fs-6 para">
      Imagine being able to identify at-risk customers before they even consider leaving. That’s the power of predictive analytics, a capability made possible by AI. By analyzing vast amounts of customer data—such as usage patterns,
    engagement metrics, and payment history—AI can forecast churn risks with remarkable accuracy.
    </p>

    <h4 class="sub-titleHead2 mb-3">Making Data-Driven Decisions in Real Time</h4>
    <p  class="text-secondary fs-6 para">
      For customer success teams, time is a precious commodity. AI-powered automation is helping these teams reclaim hours previously spent on repetitive tasks like onboarding, follow-ups, and renewals.
    Automated playbooks, for instance, guide teams through standardized processes, ensuring consistency and efficiency.
    </p>

    <h4 class="sub-titleHead2 mb-3">Conclusion</h4>
    <p  class="text-secondary fs-6 para">
      Artificial intelligence is no longer a luxury—it’s a necessity for businesses looking to thrive in today’s competitive landscape. From predictive analytics to automation, sentiment analysis,
    personalization, and real-time insights, AI is redefining what it means to achieve customer success.
    </p>





  </main>

@endsection
