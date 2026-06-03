@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">{{ __('Messages') }}</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $msg)
                                <tr>
                                    <td>{{ $msg->name }}</td>
                                    <td>{{ $msg->email }}</td>
                                    <td>{{ Str::limit($msg->subject, 40) }}</td>
                                    <td><span class="badge badge-{{ $msg->status === 'new' ? 'warning' : ($msg->status === 'replied' ? 'success' : 'secondary') }}">{{ $msg->status }}</span></td>
                                    <td>{{ $msg->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contact_messages.show', $msg) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <form class="d-inline-block" action="{{ route('admin.contact_messages.destroy', $msg) }}" method="post" onsubmit="return confirm('Delete?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
