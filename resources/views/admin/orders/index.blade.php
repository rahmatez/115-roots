@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Orders</h1>
                    <p class="text-muted mb-0" style="margin-top:0.25rem;">Process shop orders from customers</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    @if($orders->isEmpty())
                        <p class="text-center text-muted" style="padding:2rem;">No orders yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Product</th>
                                        <th>Payment Proof</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $orders->firstItem() + $loop->index }}</td>
                                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>{{ $order->customer_phone }}</td>
                                            <td>{{ Str::limit($order->customer_address, 50) }}</td>
                                            <td>{{ $order->product->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ $order->paymentProofUrl() }}" target="_blank" rel="noopener">
                                                    <img src="{{ $order->paymentProofUrl() }}" alt="Payment proof" style="width:48px;height:48px;object-fit:cover;border-radius:6px;">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <form class="d-inline-block" action="{{ route('admin.orders.destroy', $order) }}" method="post"
                                                    onsubmit="return confirm('Delete this order? This cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
