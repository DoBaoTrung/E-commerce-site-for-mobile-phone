@extends('layouts.client.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/client/filter.css') }}">
@endpush
@section('content')
    <div class="filter-content">
        <div class="brands row mb-3">
            @foreach ($manufacturers as $manufacturer)
                <div class="brand-item col-lg-2">
                    <a href="{{ route('client.filterProductsByManufacturer', ['slug' => $manufacturer->name]) }}">
                        <img class="rounded-circle" height="30" src="{{ asset(Storage::url($manufacturer->avatar)) }}" alt="brand-image">
                        {{ $manufacturer->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <h5 class="fw-bold">Chọn theo tiêu chí</h5>
            <h5 class="fw-bold">Sắp xếp theo</h5>
            <div class="filter-body card">
                <div class="filter-content card-body">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-2">
                                <div class="product-item card shadow">
                                    <div class="img-product">
                                        <img src="{{ asset(Storage::url($product->avatar)) }}" class="card-img-top img-fluid h-100"
                                        alt="product-img" title="{{ $product->name }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 style="font-size: 16px;" class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text fw-bold">{{ number_format($product->price) . '₫' }}</p>
                                        <a href="{{ route('client.product.show', ['slug' => $product->slug]) }}" class="btn btn-secondary">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach            
                    </div>
                    <div class="paginate mt-3 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection