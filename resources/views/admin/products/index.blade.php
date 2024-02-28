@extends('layouts.admin.master')
@section('content')
    <div class="products-table card">
        <div class="card-body">
            <a class="btn btn-success mb-3" href="{{ route('admin.products.create') }}">Add</a>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-striped text-center">
                <thead class="table table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Manufacturer</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="align-middle">{{ $product->id }}</td>
                            <td class="align-middle">{{ $product->name }}</td>
                            <td class="align-middle">
                                <img height="100" src="{{ asset(Storage::url($product->avatar)) }}" alt="image">
                            </td>
                            <td class="align-middle">{{ formatNumberPrice($product->price) . '₫' }}</td>
                            <td class="align-middle">{{ $product->description }}</td>
                            <td class="align-middle">{{ $product->manufacturer->name }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary" href="{{ route('admin.products.edit', ['productId' => $product->id]) }}">Edit</a>
                            </td>
                            <td class="align-middle">
                                <form id="deleteProductForm" action="{{ route('admin.products.destroy', ['productId' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate mt-3 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection