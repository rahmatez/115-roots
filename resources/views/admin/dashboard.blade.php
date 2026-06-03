@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stats['blogs'] }}</h3>
                            <p>Blog Posts</p>
                        </div>
                        <div class="icon"><i class="fas fa-book"></i></div>
                        <a href="{{ route('admin.blogs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $stats['gallery_items'] }}</h3>
                            <p>Gallery Items</p>
                        </div>
                        <div class="icon"><i class="fas fa-images"></i></div>
                        <a href="{{ route('admin.gallery_items.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $stats['contact_new'] }}</h3>
                            <p>New Messages</p>
                        </div>
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <a href="{{ route('admin.contact_messages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $stats['categories'] }}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon"><i class="fas fa-tags"></i></div>
                        <a href="{{ route('admin.categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
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
                                        <tr><td colspan="3" class="text-center">No blogs yet</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Messages ({{ $stats['contact_total'] }} total)</h3>
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
                                        <tr><td colspan="3" class="text-center">No messages yet</td></tr>
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
                        <div class="card-body">
                            <p class="mb-0">{{ __('Welcome') }}, {{ auth()->user()->name }}!</p>
                            <a href="{{ route('homepage') }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">View Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
