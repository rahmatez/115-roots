@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">Edit Gallery Image</h1>
                    <a href="{{ route('admin.gallery_items.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card p-3">
                <form method="post" action="{{ route('admin.gallery_items.update', $galleryItem) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Title (optional)</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $galleryItem->title) }}">
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        <img src="{{ Storage::url($galleryItem->image) }}" width="150" alt="">
                    </div>
                    <div class="form-group">
                        <label>Replace Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Event Album (optional)</label>
                        <select name="event_id" class="form-control">
                            <option value="">— No event —</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ old('event_id', $galleryItem->event_id) == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $galleryItem->sort_order) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" name="is_published" value="1" {{ $galleryItem->is_published ? 'checked' : '' }}> Published</label>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
