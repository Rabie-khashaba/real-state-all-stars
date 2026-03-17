@extends('website.layouts.master2')

@section('styles')
    <style>

        @font-face {
            font-family: 'NowR';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Regular.otf') }}") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowB';      /* الاسم اللي هتستخدمه لاحقًا */
            src: url("{{ asset('storage/font/Now-Bold.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowL';
            src: url("{{ asset('storage/font/Now-Light.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowM';
            src: url("{{ asset('storage/font/Now-Medium.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'NowTh';
            src: url("{{ asset('storage/font/Now-Thin.otf') }}") format("opentype");
            font-weight: normal;
            font-style: normal;
        }
        .headTitle{
            font-family: 'NowM', sans-serif;
            font-size: 45px;
        }

        .subtitle{
            font-family: 'NowM', sans-serif;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .para{
            font-family: 'NowM', sans-serif;
            font-size: 16px;
            line-height: 30px;
            color: #667085;
            margin-bottom: 30px;
        }

        @media (max-width: 767px) {
            .headTitle{
            font-size: 30px;
            }
            .subtitle{
            font-size: 24px;
            }
            .para{
                font-family: 'NowM', sans-serif;
                font-size: 16px;
                line-height: 30px;
                color: #667085;
                margin-bottom: 30px;
            }
        }





</style>



@endsection

@section('content')
<section class="py-5">
  <div class="container">
    <!-- العنوان الرئيسي -->
    <h2 class=" headTitle" style="font-family: 'NowB', sans-serif;">Terms of Service</h2>
    <hr class="mb-4" style="border-top: 2px solid #000; width: 100%;">

    <!-- القسم: Introduction -->
    <h4 class="subtitle">Introduction</h4>
    <p class="para ">
      Welcome to the Real Estate All-Stars website. By accessing or using our website, you agree to comply with and be bound by the following terms and conditions. Please read them carefully. If you do not agree with any part of these terms, you must not use our website.
    </p>

    <!-- القسم: Eligibility -->
    <h5 class="subtitle" >1. Eligibility</h5>
    <p class="para">
        Participation in Real Estate All-Stars is open to individuals who meet the specified eligibility criteria, including age, residency, and professional background. By registering for the competition, you confirm that you meet these criteria.
    </p>


    <h5 class="subtitle" >2. Registration and Participation</h5>
        <p class="para">
    - Accuracy of Information: You agree to provide accurate and complete information during the registration process. Any false or misleading information may result in disqualification. <br><br>
    - Video Submissions: You are responsible for ensuring that your video submissions comply with the guidelines provided. All submissions must be original and not infringe on any third-party rights.<br><br>
    - Consent: By submitting your registration and videos, you consent to the use of your personal information and video content for the purposes of the competition, including promotional activities.
    </p>



    <h5 class="subtitle" >3. Intellectual Property</h5>
        <p class="para">
        - Ownership: All content on the Real Estate All-Stars website, including text, graphics, logos, and videos, is the property of Real Estate All-Stars or its content suppliers and is protected by intellectual property laws. <br><br>
        - Use of Content: You may not reproduce, distribute, or create derivative works from any content on the website without prior written permission from Real Estate All-Stars.
    </p>

     <h5 class="subtitle" >4. Code of Conduct</h5>
        <p class="para">
       - Respectful Behavior: Participants are expected to conduct themselves respectfully and professionally. Any form of harassment, discrimination, or inappropriate behavior will not be tolerated.<br><br>
- Compliance with Rules: You agree to comply with all competition rules and guidelines. Failure to do so may result in disqualification.
    </p>


     <h5 class="subtitle" >5. Limitation of Liability</h5>
        <p class="para">
       - No Guarantees: Real Estate All-Stars does not guarantee the accuracy, completeness, or reliability of any content on the website or the outcomes of the competition.<br><br>
        - Disclaimers: The website and competition are provided on an "as-is" basis. Real Estate All-Stars disclaims all warranties, express or implied, to the fullest extent permitted by law.<br><br>
        - Liability: Real Estate All-Stars will not be liable for any direct, indirect, incidental, or consequential damages arising from your use of the website or participation in the competition.
        </p>


     <h5 class="subtitle" >6. Privacy Policy</h5>
        <p class="para">
        - Data Collection: We collect and use personal information in accordance with our Privacy Policy. By using our website and participating in the competition, you consent to the collection and use of your personal information as described in the Privacy Policy.<br><br>
- Third-Party Links: Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these websites.
    </p>


     <h5 class="subtitle" >7. Changes to Terms and Conditions</h5>
        <p class="para">
         Real Estate All-Stars reserves the right to update or modify these terms and conditions at any time without prior notice. Your continued use of the website constitutes acceptance of any changes.
    </p>


     <h5 class="subtitle" >8. Termination</h5>
        <p class="para">
       Real Estate All-Stars reserves the right to terminate or suspend your access to the website and participation in the competition at any time, without notice, for conduct that we believe violates these terms or is harmful to other participants.
    </p>


     <h5 class="subtitle" >10. Contact Information</h5>
        <p class="para">
      These terms and conditions are governed by and construed in accordance with the laws of Egypt. Any disputes arising from the use of the website or participation in the competition will be subject to the exclusive jurisdiction of the courts of Egypt.
        </p>

     <h5 class="subtitle" >3. Intellectual Property</h5>
        <p class="para">
       If you have any questions or concerns about these terms and conditions, please contact us at:<br>
        - Email:   <br>
        - Phone:  <br>
        - Address:  <br>
    </p>
    <p class="para">
        By using the Real Estate All-Stars website and participating in the competition, you agree to abide by these terms and conditions. We encourage you to review these terms regularly and contact us if you have any questions.
    </p>

  </div>
</section>


@endsection



