@extends('layouts.frontend')

@section('title', $product->name . ' | Shop')

@section('content')
    <section class="blog section">
        <div class="blog__container container">
            <div class="blog__detail" style="max-width:800px;margin:0 auto;">
                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" style="width:100%;max-height:400px;object-fit:cover;border-radius:8px;margin-bottom:2rem;">
                <span class="section__subtitle">{{ $product->category ?? 'Product' }}</span>
                <h1 class="section__title">{{ $product->name }}</h1>
                <p class="popular__price" style="font-size:1.5rem;margin:1rem 0;">
                    <span>{{ $product->currency }}</span> {{ $product->formattedPrice() }}
                </p>
                @if($product->description)
                    <div class="value__description">{!! $product->description !!}</div>
                @endif
                @if($product->external_url)
                    <a href="{{ $product->external_url }}" target="_blank" rel="noopener" class="button" style="margin-top:1.5rem;display:inline-block;">Buy Now</a>
                @endif
                <a href="{{ route('shop.index') }}" class="button" style="margin-top:1rem;display:inline-block;margin-left:.5rem;">Back to Shop</a>
            </div>
        </div>
    </section>
@endsection
