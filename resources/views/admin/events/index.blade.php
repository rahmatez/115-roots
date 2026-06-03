@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">Events</h1>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Event</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->event_date->format('d M Y H:i') }}</td>
                                    <td>{{ $event->location ?? '-' }}</td>
                                    <td>{{ $event->is_published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this event?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
