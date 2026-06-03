@extends('layouts.frontend')

@section('title', 'Events | Suicide Squad 11.5')

@section('content')
    <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/gal-top.JPG') }}" alt="" class="islands__bg" />
                    <div class="islands__container container">
                        <div class="islands__data">
                            <h2 class="islands__subtitle">Agenda</h2>
                            <h1 class="islands__title">Events</h1>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="section" id="events">
        <div class="container">
            <span class="section__subtitle" style="text-align:center;">Upcoming</span>
            <h2 class="section__title" style="text-align:center;">Community Events</h2>

            @if($upcomingEvents->isNotEmpty())
                <div class="events-list">
                    @foreach($upcomingEvents as $event)
                        <article class="events-list__item">
                            <a href="{{ route('events.show', $event->slug) }}" class="events-list__thumb-link">
                                <img src="{{ $event->imageUrl() }}" alt="{{ $event->title }}" class="events-list__thumb">
                            </a>
                            <div class="events-list__body">
                                <a href="{{ route('events.show', $event->slug) }}">
                                    <h3 class="events-list__title">{{ $event->title }}</h3>
                                </a>
                                <p class="events-list__meta">
                                    <i class="bx bx-calendar"></i> {{ $event->event_date->format('d M Y H:i') }}
                                    @if($event->location)
                                        · <i class="bx bx-map"></i> {{ $event->location }}
                                    @endif
                                </p>
                                @if($event->description)
                                    <p class="events-list__excerpt">{{ Str::limit(strip_tags($event->description), 160) }}</p>
                                @endif
                                <a href="{{ route('events.show', $event->slug) }}" class="button">View Details</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="events-list__empty">No upcoming events at the moment. Check back soon!</p>
            @endif

            @if($pastEvents->isNotEmpty())
                <h3 class="section__title" style="text-align:center;margin-top:3rem;">Past Events</h3>
                <div class="events-list">
                    @foreach($pastEvents as $event)
                        <article class="events-list__item events-list__item--past">
                            <a href="{{ route('events.show', $event->slug) }}" class="events-list__thumb-link">
                                <img src="{{ $event->imageUrl() }}" alt="{{ $event->title }}" class="events-list__thumb">
                            </a>
                            <div class="events-list__body">
                                <a href="{{ route('events.show', $event->slug) }}">
                                    <h3 class="events-list__title">{{ $event->title }}</h3>
                                </a>
                                <p class="events-list__meta">
                                    <i class="bx bx-calendar"></i> {{ $event->event_date->format('d M Y') }}
                                    @if($event->location)
                                        · <i class="bx bx-map"></i> {{ $event->location }}
                                    @endif
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

@push('style-alt')
<style>
    .events-list {
        display: flex;
        flex-direction: column;
        gap: 0;
        max-width: 900px;
        margin: 2rem auto 0;
    }

    .events-list__item {
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
        padding: 1.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .events-list__item:last-child {
        border-bottom: none;
    }

    .events-list__item--past {
        opacity: 0.85;
    }

    .events-list__thumb-link {
        flex-shrink: 0;
    }

    .events-list__thumb {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .events-list__title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: var(--title-color);
        transition: color 0.3s;
    }

    .events-list__title:hover {
        color: var(--first-color-light);
    }

    .events-list__meta {
        font-size: 0.875rem;
        color: var(--text-color-light);
        margin-bottom: 0.75rem;
    }

    .events-list__excerpt {
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .events-list__empty {
        text-align: center;
        padding: 2rem 0;
        color: var(--text-color-light);
    }

    @media screen and (max-width: 576px) {
        .events-list__item {
            flex-direction: column;
        }

        .events-list__thumb {
            width: 100%;
            height: 180px;
        }
    }
</style>
@endpush
