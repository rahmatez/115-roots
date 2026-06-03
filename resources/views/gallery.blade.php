@extends('layouts.frontend')

@section('content')
    {{-- <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <!--========== ISLANDS 1 ==========-->
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/contact-hero.jpg') }}" alt="" class="islands__bg" />
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
    </section> --}}
    <section class="gallery-header">
        <img src="{{ asset('frontend/assets/img/gal-top.JPG') }}" alt="" class="islands__bg" />
        <div class="bg__overlay_gallery">
            <div class="gallery-content container">
                <div class="islands__data">
                    <h2 class="islands__subtitle">Explore</h2>
                    <h1 class="islands__title">Our Gallery</h1>
                </div>
            </div>
        </div>
        <div class="gallery-title">
            <h2>Explore</h2>
            <h1>Gallery</h1>
        </div>
    </section>

    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <div class="elfsight-app-9d1f1a52-5d69-4a9e-905f-bb3ef4f61072 feed" data-elfsight-app-lazy></div>
@endsection
