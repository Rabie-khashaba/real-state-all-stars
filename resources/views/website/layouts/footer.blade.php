<footer class="footer">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Box 1 -->


            <div class="col-6 d-flex align-items-center justify-content-center footer-box">
                <p class="mb-0 text-white">{{__('home.all_right')}}</p>
            </div>

            <!-- Box 2 -->
            <div class="col-6 d-flex align-items-center justify-content-center flex-column flex-md-row footer-box">
                <!-- Links -->
                <div class="links mb-2 mb-md-0 me-md-3 text-center">
                    <a href="{{url('/terms/services')}}" class="footer-link">{{__('home.condtion_termis')}}</a> |
                    <a href="{{url('/FAQs')}}" class="footer-link">{{__('home.FAQ')}}</a>
                </div>

                @php
                   $footer =  App\Models\Footer::first();
                @endphp
                <div class="social-icons">
                    <a href="{{$footer->instagram_url}}" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="{{$footer->snapchat_url}}" class="me-3"><i class="fab fa-snapchat-ghost"></i></a>
                    <a href="{{$footer->tiktok_url}}" class="me-3"><i class="fab fa-tiktok"></i></a>
                    <a href="{{$footer->facebook_url}}" class="me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$footer->twitter_url}}" class="me-3"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

    </div>
</footer>

<style>


    .footer {
        height: 67px;
        background: #222;
        width: 100%;
        margin: 0;
        color: #fff;
        font-size: 12px;
    }

    .footer-box {
        height: 67px;
    }

    p {
        font-family: now;
        font-weight: 500;
        font-size: 12px;
        line-height: 20px;
        margin: 0;
    }

    .footer-link {
        font-family: now;
        font-weight: 500;
        font-size: 12px;
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-link:hover {
        color: #0d6efd; /* أزرق عند hover */
    }

    .social-icons a {
        color: #fff;
        font-size: 16px;
        transition: color 0.3s;
    }

    .social-icons a:hover {
        color: #0d6efd;
    }

    /* ✅ موبايل */
    @media (max-width: 576px) {
        .footer {
            height: auto;
            padding: 15px 0;
        }
        .footer .col-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .footer-box {
            height: auto;
            flex-direction: column;
            text-align: center;
        }
        .links {
            margin-bottom: 10px;
        }
    }
</style>
