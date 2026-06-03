@extends('layouts.frontend')

@section('title', $event->title . ' | Suicide Squad 11.5')

@section('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($event->description), 160) }}">
    <meta property="og:title" content="{{ $event->title }}">
    <meta property="og:url" content="{{ route('events.show', $event->slug) }}">
    @if($event->image)
        <meta property="og:image" content="{{ url(Storage::url($event->image)) }}">
    @endif
@endsection

@section('content')
    <section class="blog section">
        <div class="blog__container container">
            <img src="{{ $event->imageUrl() }}" alt="{{ $event->title }}" style="width:100%;max-height:400px;object-fit:cover;border-radius:8px;margin-bottom:2rem;">
            <h1 class="section__title">{{ $event->title }}</h1>
            <p class="blog__description">
                <i class="bx bx-calendar"></i> {{ $event->event_date->format('d M Y H:i') }}
                @if($event->location) | <i class="bx bx-map"></i> {{ $event->location }} @endif
            </p>
            <div class="blog__detail">{!! $event->description !!}</div>

            @if($event->galleryItems->isNotEmpty())
                <h2 class="section__title" style="margin-top:3rem;">Event Gallery</h2>
                <div class="tz-gallery row">
                    @foreach($event->galleryItems as $item)
                        <div class="col-md-4 mb-3">
                            <a class="lightbox" href="{{ Storage::url($item->image) }}">
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" style="width:100%;height:200px;object-fit:cover;border-radius:8px;">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('events.index') }}" class="button" style="margin-top:2rem;display:inline-block;">Back to Events</a>
        </div>
    </section>
@endsection
