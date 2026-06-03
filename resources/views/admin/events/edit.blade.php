@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">Edit Event</h1>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card p-3">
                <form method="post" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('admin.events.partials.form', ['event' => $event])
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>ClassicEditor.create(document.querySelector('#description')).catch(console.error);</script>
@endsection
