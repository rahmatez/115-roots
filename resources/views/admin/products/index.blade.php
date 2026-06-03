@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">Products</h1>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
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
                                <th>Name</th>
                                <th>Price</th>
                                <th>Order</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ $product->imageUrl() }}" width="60" alt=""></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->currency }} {{ $product->formattedPrice() }}</td>
                                    <td>{{ $product->sort_order }}</td>
                                    <td>{{ $product->is_published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        <form class="d-inline-block" action="{{ route('admin.products.destroy', $product) }}" method="post" onsubmit="return confirm('Delete this product?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">No products yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
