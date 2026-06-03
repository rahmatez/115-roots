@extends('layouts.frontend')

@section('content')
    <!--==================== HOME ====================-->
    <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <!--========== ISLANDS 1 ==========-->
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/con-top.JPG') }}" alt="" class="islands__bg" />
                    <div class="bg__overlay">
                        <div class="islands__container container">
                            <div class="islands__data">
                                <h2 class="islands__subtitle">Need Information</h2>
                                <h1 class="islands__title">Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!--==================== CONTACT ====================-->
    <section class="contact section" id="contact">
        <div class="contact__container container grid">
            <div class="contact__images">
                <div class="contact__orbe"></div>

                <div class="contact__img">
                    <img src="{{ asset('frontend/assets/img/contact-img.PNG') }}" alt="" />
                </div>
            </div>

            <div class="contact__content">
                <div class="contact__data">
                    <span class="section__subtitle">Need Help</span>
                    <h2 class="section__title">Don't hesitate to contact us</h2>
                    <p class="contact__description">
                        Are you still confused about the information on this website page? Don't worry, just contact us for
                        more information.
                    </p>
                </div>

                <div class="contact__card">
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxl-youtube"></i>
                            <div>
                                <h3 class="contact__card-title">Youtube</h3>
                                <p class="contact__card-description">suicidesquad11.5</p>
                            </div>
                        </div>
                        <a href="https://www.youtube.com/@suicidesquad11.52" target="_blank">
                            <button class="button contact__card-button">Visit Now</button>
                        </a>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxl-twitter"></i>
                            <div>
                                <h3 class="contact__card-title">Twitter</h3>
                                <p class="contact__card-description">suicidesquad76</p>
                            </div>
                        </div>
                        <a target="_blank" href="https://twitter.com/suicidesquad76">
                            <button class="button contact__card-button">Visit Now</button>
                        </a>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxs-envelope"></i>
                            <div>
                                <h3 class="contact__card-title">Email</h3>
                                <p class="contact__card-description">squadsuicide170 @gmail.com</p>
                            </div>
                        </div>
                        <a href="mailto:squadsuicide170@gmail.com" target="_blank"></a>
                        <button class="button contact__card-button">
                            Email Now
                        </button>
                    </div>
                    <div class="contact__card-box">
                        <div class="contact__card-info">
                            <i class="bx bxl-instagram"></i>
                            <div>
                                <h3 class="contact__card-title">Instagram</h3>
                                <p class="contact__card-description">Suicide Squad 11.5</p>
                            </div>
                        </div>
                        <a href="https://www.instagram.com/suicidesquad11.5/" target="_blank">
                            <button class="button contact__card-button">Visit Now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
