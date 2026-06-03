@extends('layouts.frontend')

@section('title', 'Our Shop | Suicide Squad 11.5')

@section('meta')
    <meta name="description" content="Official merchandise and supporter gear from Suicide Squad 11.5.">
@endsection

@section('content')
    <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/square-banner.jpg') }}" alt="" class="islands__bg" />
                    <div class="islands__container container">
                        <div class="islands__data">
                            <h2 class="islands__subtitle">Best Choice</h2>
                            <h1 class="islands__title">Our Shop</h1>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="section" id="shop">
        <div class="container">
            @if($products->isEmpty())
                <p style="text-align:center;padding:2rem;">No products available yet. Check back soon!</p>
            @else
                <div class="popular__container swiper">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            <article class="popular__card swiper-slide">
                                <a href="{{ $product->external_url ?: route('shop.show', $product->slug) }}">
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="popular__img">
                                    <div class="popular__data">
                                        <h2 class="popular__price">
                                            <span>{{ $product->currency }}</span> {{ $product->formattedPrice() }}
                                        </h2>
                                        <h3 class="popular__title">{{ $product->name }}</h3>
                                        @if($product->category)
                                            <p class="popular__description">{{ $product->category }}</p>
                                        @endif
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"><i class="bx bx-chevron-right"></i></div>
                    <div class="swiper-button-prev"><i class="bx bx-chevron-left"></i></div>
                </div>

                <div class="blog__content grid" style="margin-top:3rem;">
                    @foreach($products as $product)
                        <article class="blog__card">
                            <div class="blog__image">
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="blog__img">
                                <a href="{{ $product->external_url ?: route('shop.show', $product->slug) }}" class="blog__button">
                                    <i class="bx bx-right-arrow-alt"></i>
                                </a>
                            </div>
                            <div class="blog__data">
                                <h2 class="blog__title">{{ $product->name }}</h2>
                                <p class="blog__description">{{ $product->currency }} {{ $product->formattedPrice() }}</p>
                                @if($product->category)
                                    <p class="blog__description">{{ $product->category }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
