@extends('layouts.client.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/client/cart.css') }}">
@endpush
@section('content')
    <div class="go-back-button mb-3">
        <a class="text-decoration-none text-dark fs-5" href="javascript:window:history.back();">
            <i class='fas fa-less-than'></i>
            <strong>Quay lại</strong>
        </a>
    </div>
    @if (!$cartItems)
        <div class="no-item p-4 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('img/no-item.png') }}" alt="no-item-img" style="width: 592px; height: 333px;">
            <p class="mt-3 fw-bold">Hiện chưa có sản phẩm nào trong giỏ hàng</p>
        </div>
    @else
        <div class="cart-view card shadow">
            <div class="card-header text-center">
                <h4>Giỏ hàng của bạn</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th class="col-2">Tên sản phẩm</th>
                            <th class="col-2">Ảnh sản phẩm</th>
                            <th class="col-4">Mô tả sản phẩm</th>
                            <th class="col-1">Số lượng</th>
                            <th class="col-2">Giá tiền</th>
                            <th class="col-1">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $product_id => $cartItem)
                            <tr>
                                <td>
                                    <a class="cart-product-link" href="{{ route('client.product.show', ['slug' => $cartItem['slug']]) }}">
                                        {{ $cartItem['product_name'] }}
                                    </a>
                                </td>
                                <td>
                                    <img height="100" src="{{ asset(Storage::url($cartItem['avatar'])) }}" alt="product_img">
                                </td>
                                <td>{{ $cartItem['description'] }}</td>
                                <td>{{ $cartItem['quantity'] }}</td>
                                <td>{{ number_format($cartItem['total_price']) . '₫' }}</td>
                                <td>
                                    <form action="{{ route('client.cart.deleteOneProductInCart', ['productId' => $product_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete-product-in-cart btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="stickyBottomBar card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="price-temp col-9">
                        <p class="fw-bold fs-5">Tổng tiền: </p>
                        <span class="total-price text-danger fw-bold fs-4">{{ number_format($totalPrice) . '₫' }}</span>
                    </div>
                    <div class="button-buy-product col-2 offset-1 d-flex justify-content-end align-items-center">
                        <a href="{{ route('client.cart.orderInfo') }}" class="btn btn-primary">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection