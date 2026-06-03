@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="m-0">Dashboard</h1>
                        <p class="text-muted mb-0" style="margin-top:0.25rem;">Welcome back, {{ auth()->user()->name }}</p>
                    </div>
                    <a href="{{ route('homepage') }}" target="_blank" class="btn btn-outline-primary">
                        <i class="bx bx-link-external"></i> View Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="stat-grid">
                <a href="{{ route('admin.blogs.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['blogs'] }}</div>
                        <div class="stat-card__label">Blog Posts</div>
                        <span class="stat-card__footer">Manage articles &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--blue"><i class="bx bx-book-content"></i></div>
                </a>

                <a href="{{ route('admin.events.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['events'] }}</div>
                        <div class="stat-card__label">Events</div>
                        <span class="stat-card__footer">View schedule &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--purple"><i class="bx bx-calendar-event"></i></div>
                </a>

                <a href="{{ route('admin.products.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['products'] }}</div>
                        <div class="stat-card__label">Shop Products</div>
                        <span class="stat-card__footer">Manage shop &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--green"><i class="bx bx-store"></i></div>
                </a>

                <a href="{{ route('admin.contact_messages.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['contact_new'] }}</div>
                        <div class="stat-card__label">New Messages</div>
                        <span class="stat-card__footer">{{ $stats['contact_total'] }} total &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--amber"><i class="bx bx-envelope"></i></div>
                </a>

                <a href="{{ route('admin.gallery_items.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['gallery_items'] }}</div>
                        <div class="stat-card__label">Gallery Items</div>
                        <span class="stat-card__footer">Manage photos &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--rose"><i class="bx bx-images"></i></div>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['orders'] }}</div>
                        <div class="stat-card__label">Shop Orders</div>
                        <span class="stat-card__footer">Process orders &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--amber"><i class="bx bx-cart"></i></div>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="stat-card">
                    <div>
                        <div class="stat-card__value">{{ $stats['categories'] }}</div>
                        <div class="stat-card__label">Categories</div>
                        <span class="stat-card__footer">Blog categories &rarr;</span>
                    </div>
                    <div class="stat-card__icon stat-card__icon--blue"><i class="bx bx-purchase-tag"></i></div>
                </a>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Blog Posts</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentBlogs as $blog)
                                        <tr>
                                            <td><a href="{{ route('admin.blogs.edit', $blog) }}">{{ Str::limit($blog->title, 40) }}</a></td>
                                            <td>{{ $blog->category->name ?? '-' }}</td>
                                            <td>{{ $blog->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center text-muted">No blogs yet</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Messages</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentMessages as $msg)
                                        <tr>
                                            <td><a href="{{ route('admin.contact_messages.show', $msg) }}">{{ $msg->name }}</a></td>
                                            <td>{{ Str::limit($msg->subject, 30) }}</td>
                                            <td><span class="badge badge-{{ $msg->status === 'new' ? 'warning' : 'secondary' }}">{{ $msg->status }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center text-muted">No messages yet</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Recent Orders</h3>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->customer_name }}</a></td>
                                            <td>{{ $order->product->name ?? '-' }}</td>
                                            <td>{{ $order->customer_phone }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center text-muted">No orders yet</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
