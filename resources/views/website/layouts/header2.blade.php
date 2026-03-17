<nav id="mainNavbar"
     class="navbar navbar-expand-lg navbar-light bg-white position-fixed top-0 w-100 shadow-sm"
     style="z-index: 1000; padding-top: 15px; padding-bottom: 15px;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{url('/')}}">
            <img id="navbarLogo" src="{{ asset('public/images/logo/all stars logoB.1.webp') }}" alt="Logo"
                 style="width: 160px; height: auto;">
        </a>

        <!-- ✅ Toggle + Sign In (Mobile only) -->
        <div class="d-flex align-items-center ms-auto d-lg-none gap-2">
                 @auth
            <div class="dropdown d-inline-block">
                <button class="btn btn-dark rounded-pill px-3 me-3 dropdown-toggle"
                        type="button"
                        id="userMenuSmall"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="font-size: 14px; font-family: 'NowM', sans-serif">
                    <i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuSmall">
                    <li>
                        @if(auth()->check() && auth()->user()->type === 'voter')
                            <a class="dropdown-item" href="{{ url('/voter/profile' , auth()->user()->id) }}">
                                <i class="fa-regular fa-id-badge me-2"></i> {{__('home.My Profile')}}
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">
                                <i class="fa-regular fa-id-badge me-2"></i> {{__('home.My Profile')}}
                            </a>
                        @endif
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> {{__('home.Logout')}}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
                <a href="{{ url('signIn') }}"
                id="signinBtn"
                class="btn btn-dark rounded-pill px-3 me-3"
                style="font-size: 14px; font-family: 'NowM', sans-serif">
                    {{ __('home.sign_in') }}
                </a>
            @endauth
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
        </div>

        <!-- ✅ Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center" id="navbarLinks">
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/about') }}">{{ __('home.who_we_are') }}</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/judge') }}">{{ __('home.judges') }}</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/vote') }}">{{ __('home.votes') }}</a></li>
                <!--<li class="nav-item"><a class="nav-link text-dark" href="{{ url('/developers') }}">{{ __('home.developers') }}</a></li>-->
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/partners') }}">{{ __('home.partners') }}</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/ranking') }}">{{ __('home.Ranking') }}</a></li>
                <!--<li class="nav-item"><a class="nav-link text-dark" href="{{ url('/news/updates') }}">{{ __('home.news_updates') }}</a></li>-->
                <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/contact-us') }}">{{ __('home.contact') }}</a></li>

                <li><hr class="dropdown-divider d-lg-none"></li>
                <li class="nav-item dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="mobileLangSwitcher" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('home.country') }}
                    </a>
                    <ul class="dropdown-menu text-center" aria-labelledby="mobileLangSwitcher">
                         <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{'/country/egypt'}}">
                            <img src="https://flagcdn.com/w20/eg.png" alt="Egypt Flag" width="20" height="14">
                            <span>{{__('home.egypt')}}</span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/ksa'}}">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://flagcdn.com/w20/sa.png" alt="Saudi Flag" width="20" height="14">
                                <span>{{__('home.ksa')}}</span>
                            </div>
                            <small>(Coming soon)</small>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/uae'}}">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://flagcdn.com/w20/ae.png" alt="UAE Flag" width="20" height="14">
                                <span>{{__('home.uae')}}</span>
                            </div>
                            <small>(Coming soon)</small>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/qatar'}}">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://flagcdn.com/w20/qa.png" alt="Qatar Flag" width="20" height="14">
                                <span>{{__('home.qatar')}}</span>
                            </div>
                            <small>(Coming soon)</small>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/oman'}}">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://flagcdn.com/w20/om.png" alt="Qatar Flag" width="20" height="14">
                                <span>{{__('home.oman')}}</span>
                            </div>
                            <small>(Coming soon)</small>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Language -->
                <li class="nav-item dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="mobileLangDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu text-center" aria-labelledby="mobileLangSwitcher">
                        <a class="dropdown-item" href="{{ route('change.lang', 'en') }}">EN</a>
                        <a class="dropdown-item" href="{{ route('change.lang', 'ar') }}">AR</a>
                    </ul>
                </li>
            </ul>

            <!-- ✅ Desktop buttons -->
            <div class="d-none d-lg-flex align-items-center gap-2">
                @auth
                <div class="dropdown d-inline-block">
                    <button class="btn btn-dark rounded-pill px-4 dropdown-toggle"
                            type="button"
                            id="desktopUserMenu"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="font-size: 14px; font-family: 'NowM', sans-serif">
                        <i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="desktopUserMenu">
                        <li>
                            @if(auth()->check() && auth()->user()->type === 'voter')
                                <a class="dropdown-item" href="{{ url('/voter/profile' , auth()->user()->id) }}">
                                    <i class="fa-regular fa-id-badge me-2"></i> {{__('home.My Profile')}}
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">
                                    <i class="fa-regular fa-id-badge me-2"></i> {{__('home.My Profile')}}
                                </a>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> {{__('home.Logout')}}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                    <a href="{{ url('signIn') }}"
                    class="btn btn-dark rounded-pill px-4 me-3"
                    id="signinBtn"
                    style="font-size: 14px; font-family: 'NowM', sans-serif">
                        {{ __('home.sign_in') }}
                    </a>
                @endauth

                <!-- 🌐 Language Switcher for Desktop -->
                <div class="dropdown">
                    <a style="font-size: 14px; font-family: 'NowM', sans-serif"
                       class="text-dark text-decoration-none dropdown-toggle"
                       href="{{'/country/egypt'}}" role="button" id="langSwitcher"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('home.country') }}
                    </a>
                   <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langSwitcher">
                      <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{'/country/egypt'}}">
                          <img src="https://flagcdn.com/w20/eg.png" alt="Egypt Flag" width="20" height="14">
                          <span>{{__('home.egypt')}}</span>
                        </a>
                      </li>
                    
                      <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/ksa'}}">
                          <div class="d-flex align-items-center gap-2">
                            <img src="https://flagcdn.com/w20/sa.png" alt="Saudi Flag" width="20" height="14">
                            <span>{{__('home.ksa')}}</span>
                          </div>
                          <small>(Coming soon)</small>
                        </a>
                      </li>
                    
                      <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/uae'}}">
                          <div class="d-flex align-items-center gap-2">
                            <img src="https://flagcdn.com/w20/ae.png" alt="UAE Flag" width="20" height="14">
                            <span>{{__('home.uae')}}</span>
                          </div>
                          <small>(Coming soon)</small>
                        </a>
                      </li>
                    
                      <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/qatar'}}">
                          <div class="d-flex align-items-center gap-2">
                            <img src="https://flagcdn.com/w20/qa.png" alt="Qatar Flag" width="20" height="14">
                            <span>{{__('home.qatar')}}</span>
                          </div>
                          <small>(Coming soon)</small>
                        </a>
                      </li>
                    
                      <li>
                        <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 text-muted" href="{{'/country/oman'}}">
                          <div class="d-flex align-items-center gap-2">
                            <img src="https://flagcdn.com/w20/om.png" alt="Qatar Flag" width="20" height="14">
                            <span>{{__('home.oman')}}</span>
                          </div>
                          <small>(Coming soon)</small>
                        </a>
                      </li>
                    </ul>

                </div>
                
                
                 <div class="dropdown">
                    <a style="font-size: 14px; font-family: 'NowM', sans-serif ; color:#000;" class="text-dark text-decoration-none dropdown-toggle"
                    href="#" role="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <a class="dropdown-item" href="{{ route('change.lang', 'en') }}">EN</a>
                        <a class="dropdown-item" href="{{ route('change.lang', 'ar') }}">AR</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- ✅ علشان المحتوى ما يغطاش تحت الـ navbar -->
<div style="height: 120px;"></div>

<style>
    /* ✅ Toggle icon (hamburger) */
    @font-face {
        font-family: 'NowR';
        src: url("{{ asset('public/font/Now-Regular.otf') }}") format('opentype');
    }
    @font-face {
        font-family: 'NowB';
        src: url("{{ asset('public/font/Now-Bold.otf') }}") format("opentype");
    }
    @font-face {
        font-family: 'NowL';
        src: url("{{ asset('public/font/Now-Light.otf') }}") format("opentype");
    }
    @font-face {
        font-family: 'NowM';
        src: url("{{ asset('public/font/Now-Medium.otf') }}") format("opentype");
    }
    @font-face {
        font-family: 'NowTh';
        src: url("{{ asset('public/font/Now-Thin.otf') }}") format("opentype");
    }

    .navbar-toggler {
        width: 30px;
        height: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0;
    }
    .toggler-icon {
        display: block;
        width: 100%;
        height: 3px;
        background-color: #000;
        transition: all 0.3s ease;
    }
    .nav-item {
        font-family: 'NowR', sans-serif;
        line-height: 24px;
        margin-bottom: 16px;
    }
    .nav-link {
        font-family: 'NowR', sans-serif;
        font-size: 16px;
    }
    .dropdown-item {
        font-family: 'NowM', sans-serif;
        font-size: 14px;
    }
    .dropdown-item small {
      color: #9F9898;
      font-size: 12px;
    }

    .navbar-toggler[aria-expanded="true"] .toggler-icon:nth-child(1) {
        transform: rotate(45deg) translateY(8px);
    }
    .navbar-toggler[aria-expanded="true"] .toggler-icon:nth-child(2) {
        opacity: 0;
    }
    .navbar-toggler[aria-expanded="true"] .toggler-icon:nth-child(3) {
        transform: rotate(-45deg) translateY(-8px);
    }
    
    
</style>





<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const desktopLang = document.getElementById("langDropdown");
//     const desktopItems = document.querySelectorAll("#langDropdown + .dropdown-menu .dropdown-item");

//     const mobileLang = document.getElementById("mobileLangDropdown");
//     const mobileItems = document.querySelectorAll("#mobileLangDropdown + .dropdown-menu .dropdown-item");

//     // دالة لتغيير اللغة
//     function changeLanguage(selectedLang) {
//         // غيّر النص في الزرين
//         desktopLang.textContent = selectedLang;
//         mobileLang.textContent = selectedLang;

//         // غيّر الاتجاه
//         if (selectedLang === "AR") {
//             document.documentElement.setAttribute("dir", "rtl");
//             document.documentElement.setAttribute("lang", "ar");
//             document.body.classList.add("rtl-mode");
//             document.body.classList.remove("ltr-mode");
//         } else {
//             document.documentElement.setAttribute("dir", "ltr");
//             document.documentElement.setAttribute("lang", "en");
//             document.body.classList.add("ltr-mode");
//             document.body.classList.remove("rtl-mode");
//         }

//         // حفظ اللغة
//         localStorage.setItem("selectedLang", selectedLang);

//         // ✅ إعادة تحميل الصفحة لتطبيق التغييرات بالكامل
//         setTimeout(() => location.reload(), 200);
//     }

//     // Desktop items
//     desktopItems.forEach(item => {
//         item.addEventListener("click", function(e) {
//             e.preventDefault();
//             changeLanguage(this.textContent.trim());
//         });
//     });

//     // Mobile items
//     mobileItems.forEach(item => {
//         item.addEventListener("click", function(e) {
//             e.preventDefault();
//             // تأخير بسيط علشان الـ dropdown يتقفل الأول على الموبايل
//             setTimeout(() => changeLanguage(this.textContent.trim()), 200);
//         });
//     });

//     // ✅ عند تحميل الصفحة
//     const savedLang = localStorage.getItem("selectedLang");
//     if (savedLang) {
//         desktopLang.textContent = savedLang;
//         mobileLang.textContent = savedLang;

//         if (savedLang === "AR") {
//             document.documentElement.setAttribute("dir", "rtl");
//             document.documentElement.setAttribute("lang", "ar");
//             document.body.classList.add("rtl-mode");
//         } else {
//             document.documentElement.setAttribute("dir", "ltr");
//             document.documentElement.setAttribute("lang", "en");
//             document.body.classList.add("ltr-mode");
//         }
//     }
    
    
//     window.dispatchEvent(new Event('languageChanged'));

// });
</script>



