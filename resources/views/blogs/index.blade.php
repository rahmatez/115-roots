@extends('layouts.frontend')

@section('content')
    <section>
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
                <section class="islands swiper-slide">
                    <img src="{{ asset('frontend/assets/img/blog-top.JPG') }}" alt="" class="islands__bg" />
                    <div class="islands__container container">
                        <div class="islands__data">
                            <h2 class="islands__subtitle">Our</h2>
                            <h1 class="islands__title">Article</h1>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="blog section" id="blog">
        <div class="blog__container container">
            <span class="section__subtitle" style="text-align: center">All Article</span>
            <h2 class="section__title" style="text-align: center">Speech For The Pride</h2>

            <form method="get" action="{{ route('blog.index') }}" class="mb-4" style="max-width:400px;margin:0 auto 2rem;">
                <div class="input-group">
                    <input type="search" name="q" class="form-control" placeholder="Search articles..." value="{{ request('q') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="blog__content grid">
                @forelse ($blogs as $blog)
                    <article class="blog__card">
                        <div class="blog__image">
                            <img src="{{ Storage::url($blog->image) }}" alt="" class="blog__img" />
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog__button">
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                        <div class="blog__data">
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <h2 class="blog__title">{{ $blog->title }}</h2>
                            </a>
                            <p class="blog__description">{{ $blog->excerpt }}</p>
                            <div class="blog__footer">
                                <div class="blog__reaction">{{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}</div>
                                <div class="blog__reaction"><i class="bx bx-show"></i><span>{{ $blog->reads }}</span></div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p style="text-align:center;grid-column:1/-1;">No articles found.</p>
                @endforelse
            </div>

            <div style="margin-top:2rem;">
                {{ $blogs->withQueryString()->links() }}
            </div>
        </div>
    </section>

    <style>.contact-area { display: none; }</style>
@endsection
