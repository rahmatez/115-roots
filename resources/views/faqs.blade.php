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
                    <img src="{{ asset('frontend/assets/img/contact-top.png') }}" alt="" class="islands__bg" />
                    <div class="islands__container container">
                        <div class="islands__data">
                            <h2 class="islands__subtitle">Support</h2>
                            <h1 class="islands__title">{{ $page->title ?? 'FAQs' }}</h1>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="contact section">
        <div class="contact__container container">
            <div class="contact__data">
                <span class="section__subtitle">{{ $page->subtitle ?? 'Help Center' }}</span>
                <h2 class="section__title">{{ $page->title ?? 'Frequently Asked Questions' }}</h2>
                <div class="contact__description">
                    @if($page && $page->content)
                        {!! $page->content !!}
                    @else
                        <p>Contact us if you have more questions.</p>
                    @endif
                </div>
                <a href="{{ route('contact') }}">
                    <button type="button" class="button contact__card-button learn_more">Contact Us</button>
                </a>
            </div>
        </div>
    </section>
@endsection
