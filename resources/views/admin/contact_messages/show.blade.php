@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">Message Detail</h1>
                    <a href="{{ route('admin.contact_messages.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <p><strong>From:</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                    <p><strong>Subject:</strong> {{ $message->subject }}</p>
                    <p><strong>Date:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
                    <hr>
                    <p>{{ $message->message }}</p>
                    <hr>
                    <form method="post" action="{{ route('admin.contact_messages.update', $message) }}">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="new" {{ $message->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
