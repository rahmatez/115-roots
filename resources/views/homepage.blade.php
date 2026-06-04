@extends('layouts.frontend')

@section('meta')
    <meta name="description" content="{{ $siteSettings?->meta_description ?? 'Eleven Five Roots — Suicide Squad 11.5 supporter community for PSS Sleman.' }}">
    <meta property="og:title" content="{{ $siteSettings?->meta_title ?? 'Eleven Five Roots' }}">
    <meta property="og:description" content="{{ $siteSettings?->meta_description ?? 'Unite To Empower — Supporter community for PSS Sleman.' }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
@endsection

@section('content')
    @if(!empty($siteSettings?->settings['announcement_active']) && !empty($siteSettings?->settings['announcement_text']))
        <div class="homepage-announcement">
            @if(!empty($siteSettings->settings['announcement_url']))
                <a href="{{ $siteSettings->settings['announcement_url'] }}">{{ $siteSettings->settings['announcement_text'] }}</a>
            @else
                {{ $siteSettings->settings['announcement_text'] }}
            @endif
        </div>
    @endif

    {{-- Hero Section --}}
    <div class="hero">
        <div class="background-hero" aria-hidden="true">
            @foreach($heroImages as $index => $heroImage)
                <img class="hero-bg {{ $index === 0 ? 'show-hero' : '' }}"
                    src="{{ asset($heroImage) }}" alt="">
            @endforeach
        </div>

        <h1>{{ $siteSettings?->settings['hero_title'] ?? 'Eleven Five Roots' }}</h1>
        <p>{!! nl2br(e($siteSettings?->settings['hero_subtitle'] ?? 'Unite To Empower')) !!}</p>
    </div>

    {{-- 3. About / Introduction --}}
    <section class="value section" id="value">
        <div class="value__container container grid">
            <div class="value__images">
                <div class="value__orbe value__orbe--photo"
                    style="background-image: url('{{ asset('frontend/assets/img/value-img.JPG') }}')"
                    role="img"
                    aria-label="Suicide Squad 11.5 community"></div>
            </div>

            <div class="value__content">
                <div class="value__data">
                    <span class="section__subtitle">{{ $aboutPage?->subtitle ?? 'Who We Are' }}</span>
                    <h2 class="section__title">{{ $aboutPage?->title ?? 'SUICIDE SQUAD 11.5' }}</h2>
                    <div class="value__description">
                        {!! $aboutPage?->content ?? '<p>Suicide Squad 11.5 is a community of supporters dedicated to PSS Sleman.</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Shop Section --}}
    @if($products->isNotEmpty())
        <section class="section" id="shop">
            <div class="container">
                <span class="section__subtitle" style="text-align: center">Best Choice</span>
                <h2 class="section__title" style="text-align: center">Our Shop</h2>

                <div class="popular__container swiper">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            <article class="popular__card swiper-slide">
                                <a href="{{ route('shop.show', $product->slug) }}">
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
                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('shop.index') }}" class="button">View All Products</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Blog / News --}}
    <section class="blog section blog-home" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center">Our Blog</span>
            <h2 class="section__title" style="text-align: center">Speech For The Pride</h2>

            <div class="blog__content grid">
                @forelse ($blogs as $blog)
                    <article class="blog__card">
                        <div class="blog__image">
                            <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="blog__img" />
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog__button" aria-label="Read {{ $blog->title }}">
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                        <div class="blog__data">
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <h2 class="blog__title">{{ $blog->title }}</h2>
                            </a>
                            <p class="blog__description">{{ $blog->excerpt }}</p>
                            <div class="blog__footer">
                                <div class="blog__reaction">
                                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                                </div>
                                <div class="blog__reaction">
                                    <i class="bx bx-show"></i>
                                    <span>{{ $blog->reads }}</span>
                                </div>
                                <button type="button" class="blog__reaction blog__share share-button"
                                    data-title="{{ $blog->title }}"
                                    data-route="{{ route('blog.show', $blog->slug) }}">
                                    <i class="bx bx-share-alt"></i>
                                    <span>Share</span>
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="blog-home__empty">No articles yet.</p>
                @endforelse
            </div>

            @if($blogs->isNotEmpty())
                <div class="blog-home__more">
                    <a href="{{ route('blog.index') }}" class="button">Article More</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Gallery slider (Instagram feed) --}}
    @php
        $staticGallery = ['gal-1.jpg', 'gal-2.jpg', 'gal-3.jpg', 'gal-4.jpg', 'gal-5.jpg'];
        if ($instagramMedia->isNotEmpty()) {
            $gallerySlides = $instagramMedia->concat($instagramMedia)->concat($instagramMedia);
            $useInstagram = true;
        } else {
            $gallerySlides = collect(array_merge($staticGallery, $staticGallery, $staticGallery));
            $useInstagram = false;
        }
    @endphp
    <div class="tz-gallery">
        <div class="slideshow-img">
            <div class="gallery-slider-pot">
                <div class="slide-track-pot">
                    @foreach($gallerySlides as $item)
                        <div class="slide-item-pot">
                            @if($useInstagram)
                                <a class="lightbox" href="{{ $item['media_url'] }}" target="_blank" rel="noopener">
                                    <img src="{{ $item['image_url'] }}" alt="Instagram" loading="lazy">
                                </a>
                            @else
                                <a class="lightbox" href="{{ asset('frontend/assets/img/' . $item) }}">
                                    <img src="{{ asset('frontend/assets/img/' . $item) }}" alt="Gallery">
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- YouTube video --}}
    @php
        $youtubeEmbed = $siteSettings?->settings['youtube_embed_url']
            ?? 'https://www.youtube.com/embed/fLLJzNB15mI?si=CY6u_7UdphzYDAB2';
    @endphp
    <section class="container section" id="video">
        <div class="video-section">
            <iframe class="youtube-video" src="{{ $youtubeEmbed }}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
        @if(!empty($siteSettings?->settings['youtube_channel_url']))
            <p class="video-section__channel">
                <a href="{{ $siteSettings->settings['youtube_channel_url'] }}" target="_blank" rel="noopener">
                    Subscribe on YouTube
                </a>
            </p>
        @endif
    </section>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        (function () {
            const slides = document.querySelectorAll('.hero-bg');
            if (!slides.length) return;

            let index = 0;
            slides.forEach((img) => {
                const preload = new Image();
                preload.src = img.src;
            });

            setInterval(() => {
                slides[index].classList.remove('show-hero');
                index = (index + 1) % slides.length;
                slides[index].classList.add('show-hero');
            }, 4000);
        })();

        $('.share-button').on('click', function() {
            const title = $(this).data('title');
            const url = $(this).data('route');
            if (navigator.share) {
                navigator.share({ title, url }).catch(() => {});
            } else if (navigator.clipboard) {
                navigator.clipboard.writeText(url);
                $(this).find('span').text('Copied!');
                setTimeout(() => $(this).find('span').text('Share'), 2000);
            }
        });
    </script>
@endsection

@push('style-alt')
<style>
    .homepage-announcement {
        margin-top: 5rem;
        padding: 0.75rem 1rem;
        text-align: center;
        background: rgba(62, 100, 255, 0.15);
        border-bottom: 1px solid var(--border-color);
        color: var(--title-color);
    }

    .homepage-announcement a { color: inherit; }

    .hero {
        position: relative;
        overflow: hidden;
    }

    .hero h1,
    .hero p {
        position: relative;
        z-index: 2;
    }

    .video-section__channel {
        text-align: center;
        margin: 1rem 0 2rem;
    }
</style>
@endpush
