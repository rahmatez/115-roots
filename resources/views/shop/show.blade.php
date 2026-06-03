@extends('layouts.frontend')

@section('title', $product->name . ' | Shop')

@section('content')
    <section class="blog section">
        <div class="blog__container container">
            <div class="shop-order" style="max-width:900px;margin:0 auto;">
                @if(session('message'))
                    <div class="shop-order__alert shop-order__alert--success">
                        <i class="bx bx-check-circle"></i> {{ session('message') }}
                    </div>
                @endif

                <div class="shop-order__grid">
                    <div class="shop-order__product">
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="shop-order__image">
                        <span class="section__subtitle">{{ $product->category ?? 'Product' }}</span>
                        <h1 class="section__title">{{ $product->name }}</h1>
                        <p class="popular__price" style="font-size:1.5rem;margin:1rem 0;">
                            <span>{{ $product->currency }}</span> {{ $product->formattedPrice() }}
                        </p>
                        @if($product->description)
                            <div class="value__description">{!! $product->description !!}</div>
                        @endif
                        @if($product->external_url)
                            <a href="{{ $product->external_url }}" target="_blank" rel="noopener" class="button" style="margin-top:1rem;display:inline-block;">
                                External Store
                            </a>
                        @endif
                    </div>

                    <div class="shop-order__form-wrap">
                        <h2 class="shop-order__form-title">Place Order</h2>
                        <p class="shop-order__form-desc">Fill in your details and upload payment proof to complete your order.</p>

                        <form method="post" action="{{ route('shop.order', $product->slug) }}" enctype="multipart/form-data" class="shop-order__form">
                            @csrf
                            <input type="text" name="website" tabindex="-1" autocomplete="off" class="shop-order__hp">

                            <div class="shop-order__field">
                                <label for="customer_name">Full Name</label>
                                <input type="text" id="customer_name" name="customer_name" class="shop-order__input @error('customer_name') is-invalid @enderror"
                                    value="{{ old('customer_name') }}" required>
                                @error('customer_name')
                                    <span class="shop-order__error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="shop-order__field">
                                <label for="customer_phone">Phone / WhatsApp</label>
                                <input type="tel" id="customer_phone" name="customer_phone" class="shop-order__input @error('customer_phone') is-invalid @enderror"
                                    value="{{ old('customer_phone') }}" placeholder="08xxxxxxxxxx" required>
                                @error('customer_phone')
                                    <span class="shop-order__error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="shop-order__field">
                                <label for="customer_address">Shipping Address</label>
                                <textarea id="customer_address" name="customer_address" rows="4" class="shop-order__input @error('customer_address') is-invalid @enderror"
                                    required>{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                    <span class="shop-order__error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="shop-order__field">
                                <label for="payment_proof">Payment Proof (photo)</label>
                                <input type="file" id="payment_proof" name="payment_proof" accept="image/jpeg,image/png,image/webp"
                                    class="shop-order__input @error('payment_proof') is-invalid @enderror" required>
                                <small class="shop-order__hint">Upload screenshot or photo of your transfer. JPG, PNG, WEBP — max 5MB.</small>
                                @error('payment_proof')
                                    <span class="shop-order__error">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="button shop-order__submit">
                                <i class="bx bx-cart"></i> Submit Order
                            </button>
                        </form>
                    </div>
                </div>

                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('shop.index') }}" class="button">Back to Shop</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style-alt')
<style>
    .shop-order__alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .shop-order__alert--success {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.4);
        color: #6ee7b7;
    }

    .shop-order__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    .shop-order__image {
        width: 100%;
        max-height: 360px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .shop-order__form-wrap {
        background: var(--container-color);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .shop-order__form-title {
        font-size: 1.25rem;
        color: var(--title-color);
        margin: 0 0 0.5rem;
    }

    .shop-order__form-desc {
        color: var(--text-color);
        font-size: 0.875rem;
        margin: 0 0 1.25rem;
    }

    .shop-order__field {
        margin-bottom: 1rem;
    }

    .shop-order__field label {
        display: block;
        font-size: 0.875rem;
        color: var(--title-color);
        margin-bottom: 0.375rem;
        font-weight: 500;
    }

    .shop-order__input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--body-color);
        color: var(--title-color);
        font-family: inherit;
        font-size: 0.9375rem;
    }

    .shop-order__input:focus {
        outline: none;
        border-color: var(--first-color);
    }

    .shop-order__input.is-invalid {
        border-color: #ef4444;
    }

    .shop-order__error {
        display: block;
        color: #f87171;
        font-size: 0.8125rem;
        margin-top: 0.25rem;
    }

    .shop-order__hint {
        display: block;
        color: var(--text-color-light);
        font-size: 0.8125rem;
        margin-top: 0.375rem;
    }

    .shop-order__submit {
        width: 100%;
        margin-top: 0.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .shop-order__hp {
        position: absolute;
        left: -9999px;
        opacity: 0;
        height: 0;
        width: 0;
    }

    @media (max-width: 768px) {
        .shop-order__grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
