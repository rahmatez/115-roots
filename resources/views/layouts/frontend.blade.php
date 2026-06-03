<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Suicide Squad" />
    <meta property="og:url" content="https://115roots.com" />
    <meta property="og:site_name" content="Suicide Squad" />
    <meta property="og:image" content="">

    <!--=============== BOXICONS ===============-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swiper-bundle.min.css') }}" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    @stack('style-alt')
    <title>Suicide Squad 11.5 | Born From Blood</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('frontend/assets/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('frontend/assets/favicon/site.webmanifest') }}">
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('homepage') }}" class="nav__logo"><img class="brand-logo"
                    src="{{ asset('frontend/assets/img/logo/logo-ss-white.png') }}" alt="" srcset=""></a>

            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('homepage') }}"
                            class="nav__link {{ request()->is('/') ? ' active-link' : '' }}">
                            <i class="bx bx-home-alt"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    {{-- <li class="nav__item">
                        <a href="{{ route('travel_package.index') }}"
                            class="nav__link {{ request()->is('travel-packages') || request()->is('travel-packages/*') ? ' active-link' : '' }}">
                            <i class="bx bx-building-house"></i>
                            <span>Package</span>
                        </a>
                    </li> --}}
                    <li class="nav__item">
                        <a href="{{ route('blog.index') }}"
                            class="nav__link {{ request()->is('blogs') || request()->is('blogs/*') ? ' active-link' : '' }}">
                            <i class="bx bx-book"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('gallery') }}"
                            class="nav__link {{ request()->is('gallery') ? ' active-link' : '' }}">
                            <i class="bx bx-image"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('contact') }}"
                            class="nav__link {{ request()->is('contact') ? ' active-link' : '' }}">
                            <i class="bx bx-phone"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- theme -->
            {{-- <i class="bx bx-moon change-theme" id="theme-button"></i> --}}

        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        @yield('content')
    </main>

    <div class="notification" id="notification-message"></div>
    

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div>
                <a href="{{ route('homepage') }}" class="footer__logo">
                    <img class="footer-logo" src="{{ asset('frontend/assets/img/logo/EMBLEM.PNG') }}"
                        alt="Desa Gabugan" srcset="">
                </a>
                <p class="footer__description">
                    Our vision is to provide the best service <br> and share the best experience for many people
                </p>
            </div>

            <div class="footer__content">
                <div>
                    <h3 class="footer__title">About</h3>

                    <ul class="footer__links">
                        {{-- <li>
                            <a href="{{ route('about-us') }}" class="footer__link">About Us</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('gallery') }}" class="footer__link">Gallery</a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}" class="footer__link">News & Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Support</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">FAQs </a>
                        </li>
                        {{-- <li>
                            <a href="#" class="footer__link">Support center
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('contact') }}" class="footer__link"> Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Follow us</h3>

                    <ul class="footer__social">
                        <a href="https://twitter.com/suicidesquad76" target="_blank" class="footer__social-link">
                            <i class="bx bxl-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/suicidesquad11.5/" target="_blank"
                            class="footer__social-link">
                            <i class="bx bxl-instagram-alt"></i>
                        </a>
                        <a href="https://www.youtube.com/@suicidesquad11.52"
                            class="footer__social-link">
                            <i class="bx bxl-youtube"></i>
                        </a>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer__info container">
            <span class="footer__copy">
                &#169; SUICIDE SQUAD 11.5. 2024. All rigths reserved.
            </span>
            <div class="footer__privacy">
                {{-- <a href="#">Terms & Agreements</a>
                <a href="#">Privacy Policy</a> --}}
                <a href="https://www.gegacreative.com/" target="_blank">Build with love by GEGA CREATIVE</a>
            </div>
        </div>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="bx bx-chevrons-up"></i>
    </a>

    <!--=============== popup image ===============-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="{{ asset('frontend/assets/libraries/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('frontend/assets/libraries/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myForm').submit(function (e) {
                e.preventDefault(); // Menghentikan pengiriman formulir standar
                // Menampilkan indikator loading dan mengubah teks tombol
                $('#submitBtn').prop('disabled', true);
                $('#submitBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...');
                // Mengirimkan data formulir dengan AJAX
                $.ajax({
                    type: "POST",
                    url: "{{ route('send.email') }}",
                    data: $('#myForm').serialize(), // Mengambil data formulir
                    success: function (response) {
                        $('#myForm')[0].reset(); // Mengosongkan formulir

                        // Menampilkan notifikasi dengan animasi fadeIn
                        $('#notification-message').removeClass('error').text(response.message).fadeIn();

                        // Menyembunyikan notifikasi setelah 3 detik
                        setTimeout(function () {
                            $('#notification-message').fadeOut();
                        }, 3000);
                    },
                    error: function (xhr, status, error) {
                        // Menampilkan notifikasi error dengan animasi fadeIn
                        $('#notification-message').addClass('error').text('Gagal mengirim email. Silakan coba lagi nanti.').fadeIn();

                        // Menyembunyikan notifikasi error setelah 3 detik
                        setTimeout(function () {
                            $('#notification-message').fadeOut();
                        }, 3000);
                    },
                    complete: function () {
                        // Menyembunyikan indikator loading dan mengembalikan teks tombol
                        $('#submitBtn').prop('disabled', false);
                        $('#submitBtn').html('Send Message');
                    }
                });
            });
        });
    </script>

    @stack('script-alt')
</body>

</html>
