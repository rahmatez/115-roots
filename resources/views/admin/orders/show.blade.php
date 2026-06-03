@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="m-0">Order #{{ $order->id }}</h1>
                        <p class="text-muted mb-0" style="margin-top:0.25rem;">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                        <i class="bx bx-arrow-back"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customer</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                            <p><strong>Address:</strong><br>{{ $order->customer_address }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product</h3>
                        </div>
                        <div class="card-body">
                            @if($order->product)
                                <p><strong>{{ $order->product->name }}</strong></p>
                                <p class="text-muted mb-0">{{ $order->product->currency }} {{ $order->product->formattedPrice() }}</p>
                                @if($order->product->category)
                                    <p class="text-muted">{{ $order->product->category }}</p>
                                @endif
                            @else
                                <p class="text-muted mb-0">Product no longer available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Proof</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ $order->paymentProofUrl() }}" target="_blank" rel="noopener">
                                <img src="{{ $order->paymentProofUrl() }}" alt="Payment proof"
                                    style="width:100%;max-height:400px;object-fit:contain;border-radius:8px;border:1px solid var(--admin-border);">
                            </a>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="post"
                                onsubmit="return confirm('Delete this order? Use when order is completed or cancelled.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bx bx-trash"></i> Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
