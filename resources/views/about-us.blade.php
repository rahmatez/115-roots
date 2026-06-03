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
                    <img src="{{ asset('frontend/assets/img/about-top.jpg') }}" alt="" class="islands__bg" />
                    <div class="bg__overlay">
                        <div class="islands__container container">
                            <div class="islands__data">
                                <h2 class="islands__subtitle">Information</h2>
                                <h1 class="islands__title">{{ $page->title ?? 'About Us' }}</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="contact section">
        <div class="contact__container container grid">
            <div class="contact__images">
                <div class="contact__orbe"></div>
                <div class="contact__img">
                    <img src="{{ asset('frontend/assets/img/about-1.jpg') }}" alt="" />
                </div>
            </div>
            <div class="contact__content">
                <div class="contact__data">
                    <span class="section__subtitle">{{ $page->subtitle ?? 'About Us' }}</span>
                    <h2 class="section__title">{{ $page->title ?? 'SUICIDE SQUAD 11.5' }}</h2>
                    <div class="contact__description">
                        @if($page && $page->content)
                            {!! $page->content !!}
                        @else
                            <p>Community of supporters dedicated to PSS Sleman.</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('contact') }}">
                    <button type="button" class="button contact__card-button learn_more">Let's Talk!</button>
                </a>
            </div>
        </div>
    </section>
@endsection
