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
    </section>

    <section class="section">
        <div class="container">
            @if($events->isNotEmpty())
                <form method="get" class="mb-4" style="text-align:center;">
                    <select name="event" onchange="this.form.submit()" style="padding:.5rem 1rem;border-radius:4px;">
                        <option value="">All albums</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ (string) request('event') === (string) $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </form>
                @if($selectedEvent)
                    <p style="color:#fff;text-align:center;margin-bottom:1.5rem;">Album: <strong>{{ $selectedEvent->title }}</strong></p>
                @endif
            @endif

            @if($galleryItems->isEmpty())
                <p class="text-center" style="color: #fff; padding: 2rem;">No gallery photos yet. Please check back later.</p>
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
                                @if($item->event && ! $selectedEvent)
                                    <p style="color:#ccc;text-align:center;font-size:.85rem;">
                                        <a href="{{ route('gallery', ['event' => $item->event_id]) }}" style="color:#ccc;">{{ $item->event->title }}</a>
                                    </p>
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
<style>.tz-gallery a { display: block; }</style>
@endpush
