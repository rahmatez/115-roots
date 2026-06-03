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
    @php
        $heroImages = $siteSettings?->settings['hero_images'] ?? [
            'frontend/assets/img/hero1.jpg',
            'frontend/assets/img/hero2.JPG',
            'frontend/assets/img/hero3.jpg',
        ];
    @endphp
    <div class="hero">
        <img class="lazy_img emblem" data-src="{{ asset('frontend/assets/img/logo/EMBLEM.png') }}" alt="Eleven Five Roots">
        <h1>{{ $siteSettings?->settings['hero_title'] ?? 'Eleven Five Roots' }}</h1>
        <p>{!! nl2br(e($siteSettings?->settings['hero_subtitle'] ?? 'Unite To Empower')) !!}</p>

        <div class="background-hero">
            @foreach($heroImages as $index => $heroImage)
                <img class="lazy_img hero-bg {{ $index === 0 ? 'show-hero' : '' }}"
                    data-src="{{ asset($heroImage) }}" alt="">
            @endforeach
        </div>
    </div>

    @php
        $partnerLogos = $siteSettings?->settings['partner_logos'] ?? [];
    @endphp
    @if(!empty($partnerLogos))
        <section class="logos hero-logos">
            <div class="logos__container container grid">
                @foreach($partnerLogos as $logo)
                    <div class="logos__img">
                        @if(!empty($logo['url']))
                            <a href="{{ $logo['url'] }}" target="_blank" rel="noopener">
                                <img src="{{ asset($logo['image']) }}" alt="{{ $logo['name'] ?? '' }}">
                            </a>
                        @else
                            <img src="{{ asset($logo['image']) }}" alt="{{ $logo['name'] ?? '' }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- 3. About / Introduction --}}
    <section class="value section" id="value">
        <div class="value__container container grid">
            <div class="values__images">
                <div class="value__orbe"></div>
                <div class="value__img">
                    <img class="lazy_img" data-src="{{ asset('frontend/assets/img/value-img.JPG') }}" alt="" />
                </div>
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
                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('shop.index') }}" class="button">View All Products</a>
                </div>
            </div>
        </section>
    @endif

    @if($upcomingEvents->isNotEmpty())
        <section class="blog section" id="events">
            <div class="blog__container container">
                <span class="section__subtitle" style="text-align: center">Agenda</span>
                <h2 class="section__title" style="text-align: center">Upcoming Events</h2>
                <div class="blog-list">
                    @foreach($upcomingEvents as $event)
                        <article class="blog-list__item">
                            <div class="blog-list__body">
                                <a href="{{ route('events.show', $event->slug) }}">
                                    <h3 class="blog-list__title">{{ $event->title }}</h3>
                                </a>
                                <p class="blog-list__excerpt">
                                    <i class="bx bx-calendar"></i> {{ $event->event_date->format('d M Y H:i') }}
                                    @if($event->location) · <i class="bx bx-map"></i> {{ $event->location }} @endif
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="blog-list__more">
                    <a href="{{ route('events.index') }}" class="button">View All Events</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Blog / News --}}
    <section class="blog section" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center">Our Blog</span>
            <h2 class="section__title" style="text-align: center">Speech For The Pride</h2>

            <div class="blog-list">
                @forelse ($blogs as $blog)
                    <article class="blog-list__item">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-list__thumb-link">
                            <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="blog-list__thumb">
                        </a>
                        <div class="blog-list__body">
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <h3 class="blog-list__title">{{ $blog->title }}</h3>
                            </a>
                            <p class="blog-list__excerpt">{{ $blog->excerpt }}</p>
                            <div class="blog-list__meta">
                                <span class="blog__reaction">
                                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                                </span>
                                <span class="blog__reaction">
                                    <i class="bx bx-show"></i>
                                    <span>{{ $blog->reads }}</span>
                                </span>
                                <button type="button" class="blog-list__share share-button"
                                    data-title="{{ $blog->title }}"
                                    data-route="{{ route('blog.show', $blog->slug) }}">
                                    <i class="bx bx-share-alt"></i>
                                    <span>Share</span>
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="blog-list__empty">No articles yet.</p>
                @endforelse
            </div>

            <div class="blog-list__more">
                <a href="{{ route('blog.index') }}" class="button">Article More</a>
            </div>
        </div>
    </section>

    {{-- Gallery slider --}}
    @php
        $staticGallery = ['gal-1.jpg', 'gal-2.jpg', 'gal-3.jpg', 'gal-4.jpg', 'gal-5.jpg'];
        if ($galleryPreview->isNotEmpty()) {
            $gallerySlides = $galleryPreview->concat($galleryPreview)->concat($galleryPreview);
            $useStorage = true;
        } else {
            $gallerySlides = collect(array_merge($staticGallery, $staticGallery, $staticGallery));
            $useStorage = false;
        }
    @endphp
    <div class="tz-gallery">
        <div class="slideshow-img">
            <div class="gallery-slider-pot">
                <div class="slide-track-pot">
                    @foreach($gallerySlides as $item)
                        <div class="slide-item-pot">
                            <a class="lightbox" href="{{ $useStorage ? Storage::url($item->image) : asset('frontend/assets/img/' . $item) }}">
                                <img src="{{ $useStorage ? Storage::url($item->image) : asset('frontend/assets/img/' . $item) }}"
                                    alt="{{ $useStorage ? ($item->title ?? 'Gallery') : 'Gallery' }}">
                            </a>
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
        let headerBackground = document.querySelectorAll(".hero-bg");
        let imageIndex = 0;
        function changeBackground() {
            if (!headerBackground.length) return;
            headerBackground[imageIndex].classList.remove("show-hero");
            imageIndex = (imageIndex + 1) % headerBackground.length;
            headerBackground[imageIndex].classList.add("show-hero");
        }
        setInterval(changeBackground, 3000);

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

    .hero-logos {
        margin-top: -4rem;
        padding-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .hero-logos .logos__img img {
        opacity: 0.85;
        height: 48px;
        width: auto;
        object-fit: contain;
    }

    .blog-list {
        display: flex;
        flex-direction: column;
        gap: 0;
        max-width: 900px;
        margin: 2rem auto 0;
    }

    .blog-list__item {
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
        padding: 1.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .blog-list__item:last-child {
        border-bottom: none;
    }

    .blog-list__thumb-link {
        flex-shrink: 0;
    }

    .blog-list__thumb {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .blog-list__title {
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
        color: var(--title-color);
        transition: color 0.3s;
    }

    .blog-list__title:hover {
        color: var(--first-color-light);
    }

    .blog-list__excerpt {
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 0.75rem;
        color: var(--text-color);
    }

    .blog-list__meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
    }

    .blog-list__share {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: none;
        border: none;
        color: var(--text-color-light);
        font-size: 0.813rem;
        cursor: pointer;
        padding: 0;
    }

    .blog-list__share:hover {
        color: var(--first-color-light);
    }

    .blog-list__more {
        text-align: center;
        margin-top: 2.5rem;
    }

    .blog-list__empty {
        text-align: center;
        padding: 2rem 0;
        color: var(--text-color-light);
    }

    .video-section__channel {
        text-align: center;
        margin: 1rem 0 2rem;
    }

    .video-section__channel {
        text-align: center;
        margin: 1rem 0 2rem;
    }

    @media screen and (max-width: 576px) {
        .blog-list__item {
            flex-direction: column;
        }

        .blog-list__thumb {
            width: 100%;
            height: 180px;
        }
    }
</style>
@endpush
