@extends('layouts.frontend')

@section('meta')
    @if($page)
        <title>{{ $page->meta_title ?? $page->title }} | Suicide Squad 11.5</title>
        @if($page->meta_description)
            <meta name="description" content="{{ $page->meta_description }}">
        @endif
    @endif
@endsection

@section('content')
    <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/con-top.JPG') }}" alt="" class="islands__bg" />
                    <div class="bg__overlay">
                        <div class="islands__container container">
                            <div class="islands__data">
                                <h2 class="islands__subtitle">{{ $page->subtitle ?? 'Need Information' }}</h2>
                                <h1 class="islands__title">{{ $page->title ?? 'Contact Us' }}</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

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
                    <span class="section__subtitle">{{ $page->subtitle ?? 'Need Help' }}</span>
                    <h2 class="section__title">{{ $page->title ?? 'Contact Us' }}</h2>
                    @if($page && $page->content)
                        <div class="contact__description">{!! $page->content !!}</div>
                    @else
                        <p class="contact__description">Don't hesitate to contact us for more information.</p>
                    @endif
                </div>

                <div class="contact__card">
                    @foreach(($page->settings['social_links'] ?? []) as $link)
                        <div class="contact__card-box">
                            <div class="contact__card-info">
                                <i class="bx {{ $link['icon'] ?? 'bx-link' }}"></i>
                                <div>
                                    <h3 class="contact__card-title">{{ $link['platform'] }}</h3>
                                    <p class="contact__card-description">{{ $link['handle'] }}</p>
                                </div>
                            </div>
                            <a href="{{ $link['url'] }}" target="_blank">
                                <button type="button" class="button contact__card-button">Visit Now</button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="contact section">
        <div class="contact__container container">
            <h2 class="section__title" style="text-align:center;margin-bottom:1.5rem;">Send us a message</h2>
            <form id="myForm" class="contact-form" style="max-width:600px;margin:0 auto;">
                @csrf
                <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;opacity:0;height:0;width:0;">
                <div class="form-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <div class="form-group mb-3">
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" id="submitBtn" class="button contact__card-button">Send Message</button>
            </form>
        </div>
    </section>
@endsection

@push('style-alt')
<style>
    .contact-form .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
</style>
@endpush
