@extends('layouts.frontend')

@section('meta')
    <meta name="description" content="Gallery - Suicide Squad 11.5 on Instagram">
@endsection

@section('content')
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
    </section>

    <section class="section">
        <div class="container">
            <p style="color:#ccc;text-align:center;margin-bottom:1.5rem;">
                Photos from our Instagram
                <a href="{{ $instagramProfileUrl }}" target="_blank" rel="noopener" style="color:var(--first-color-light);">
                    {{ '@' . ltrim($instagramUsername, '@') }}
                </a>
            </p>

            @if(!$instagramConfigured)
                <div class="instagram-gallery__notice">
                    <i class="bx bxl-instagram"></i>
                    <p>Instagram feed is not configured yet. Connect your account in Admin &rarr; Pages &rarr; Site Settings.</p>
                </div>
            @elseif($instagramMedia->isEmpty())
                <p class="text-center" style="color:#fff;padding:2rem;">No Instagram posts found. Check your API credentials in Site Settings.</p>
            @else
                <div class="tz-gallery instagram-gallery">
                    <div class="row">
                        @foreach($instagramMedia as $post)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <a class="lightbox instagram-gallery__link" href="{{ $post['media_url'] }}" data-caption="{{ Str::limit($post['caption'], 120) }}">
                                    <img src="{{ $post['image_url'] }}" alt="Instagram post" class="img-fluid instagram-gallery__img" loading="lazy">
                                    @if($post['media_type'] === 'VIDEO')
                                        <span class="instagram-gallery__video-badge"><i class="bx bx-play"></i></span>
                                    @endif
                                </a>
                                @if($post['caption'])
                                    <p class="instagram-gallery__caption">{{ Str::limit($post['caption'], 80) }}</p>
                                @endif
                                @if($post['permalink'])
                                    <p class="instagram-gallery__permalink">
                                        <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener">
                                            <i class="bx bxl-instagram"></i> View on Instagram
                                        </a>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div style="text-align:center;margin-top:2rem;">
                <a href="{{ $instagramProfileUrl }}" target="_blank" rel="noopener" class="button">
                    <i class="bx bxl-instagram"></i> Follow on Instagram
                </a>
            </div>
        </div>
    </section>
@endsection

@push('style-alt')
<style>
    .tz-gallery a { display: block; }

    .instagram-gallery__link {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .instagram-gallery__img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .instagram-gallery__link:hover .instagram-gallery__img {
        transform: scale(1.03);
    }

    .instagram-gallery__video-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .instagram-gallery__caption {
        color: #fff;
        text-align: center;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .instagram-gallery__permalink {
        text-align: center;
        margin-top: 0.35rem;
        font-size: 0.8125rem;
    }

    .instagram-gallery__permalink a {
        color: var(--text-color-light);
    }

    .instagram-gallery__permalink a:hover {
        color: var(--first-color-light);
    }

    .instagram-gallery__notice {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--text-color);
        border: 1px dashed var(--border-color);
        border-radius: 12px;
    }

    .instagram-gallery__notice i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: block;
        color: var(--first-color);
    }
</style>
@endpush
