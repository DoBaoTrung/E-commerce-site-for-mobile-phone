@extends('layouts.client.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/client/product-list.css') }}">
@endpush
@section('content')
    <div class="card shadow">
        <div class="card-header" style="background-color: #eea9b6;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9 d-flex justify-content-between">
                    <p class="card-title fs-4">Danh sách sản phẩm</p>
                    <form action="{{ route('client.home') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="search-product" id="search-product" class="form-control"
                                placeholder="Tìm kiếm" value="{{ request('search-product') }}">
                            <button class="btn btn-danger"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="card shadow">
                            <div class="card-body">
                                <ul class="category-product-list list-group">
                                    @foreach ($manufacturers as $manufacturer)
                                        <li class="category-product-item list-group-item">
                                            <a class="category-product-link text-decoration-none" href="{{ route('client.filterProductsByManufacturer', ['slug' => $manufacturer->name]) }}">{{ $manufacturer->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-3">
                                <div class="product-item shadow card">
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
@push('js')
    <script>
        // $(document).ready(function() {
        //     $('.category-product-link').click(function(event) {
        //         let name = event.target.text
        //         let routeFilter = `{{ route('client.filterProductsByManufacturer', ['slug' => ':manufacturer_name']) }}`.replace(':manufacturer_name', name);
        //         $.ajax({
        //             url: routeFilter,
        //             type: 'GET',
        //             dataType: 'json',
        //             data: '',
        //             success: function(data) {
        //                 if (data.message === 'success') {
        //                     $('.col-md-9 .row').html('');

        //                     let productHtml = data.data.map((product) => {
        //                         return `
        //                             <div class="col-md-3">
        //                                 <div class="product-item shadow card">
        //                                     <div class="img-product">
        //                                         <img src="storage/${product.avatar}" class="card-img-top img-fluid h-100" alt="product-img" title="${product.name}">
        //                                     </div>
        //                                     <div class="card-body">
        //                                         <h5 style="font-size: 16px;" class="card-title">${product.name}</h5>
        //                                         <p class="card-text fw-bold">${product.price}</p>
        //                                         <a href="{{ route('client.product.show', ['slug' => ':product_slug']) }}".replace(':product_slug', ${product.slug}) class="btn btn-secondary">Xem chi tiết</a>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         `;
        //                     });
                            
        //                     $('.col-md-9 .row').html(productHtml.join(''));
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>
@endpush
