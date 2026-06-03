@extends('layouts.frontend')

@section('meta')
    <meta name="description" content="Gallery - Suicide Squad 11.5">
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
        <div class="gallery-title">
            <h2>Explore</h2>
            <h1>Gallery</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if($galleryItems->isEmpty())
                <p class="text-center" style="color: #fff; padding: 2rem;">Belum ada foto galeri. Silakan cek kembali nanti.</p>
            @else
                <div class="tz-gallery">
                    <div class="row">
                        @foreach($galleryItems as $item)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <a class="lightbox" href="{{ Storage::url($item->image) }}">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title ?? 'Gallery' }}" class="img-fluid" style="width:100%;height:250px;object-fit:cover;border-radius:8px;">
                                </a>
                                @if($item->title)
                                    <p style="color:#fff;text-align:center;margin-top:0.5rem;">{{ $item->title }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('style-alt')
<style>
    .tz-gallery a { display: block; }
</style>
@endpush
