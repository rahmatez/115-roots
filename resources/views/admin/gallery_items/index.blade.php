@extends('layouts.app')

@section('title', 'Event Photos')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex align-items-center">
                    <div>
                        <h1 class="m-0">Event Photos</h1>
                        <p class="text-muted mb-0" style="font-size:0.875rem;margin-top:0.25rem;">For event detail albums only. Main gallery uses Instagram feed.</p>
                    </div>
                    <a href="{{ route('admin.gallery_items.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleryItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ Storage::url($item->image) }}" width="80" alt=""></td>
                                    <td>{{ $item->title ?? '-' }}</td>
                                    <td>{{ $item->sort_order }}</td>
                                    <td>{{ $item->is_published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.gallery_items.edit', $item) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        <form class="d-inline-block" action="{{ route('admin.gallery_items.destroy', $item) }}" method="post" onsubmit="return confirm('Delete this image?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $galleryItems->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
