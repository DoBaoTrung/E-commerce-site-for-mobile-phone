@extends('layouts.client.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/client/cart.css') }}">
@endpush
@section('content')
    <div class="order-form card shadow">
        <div class="card-header text-center">
            <h3>Thông tin</h3>
        </div>
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-body" id="order-list">
                    @foreach ($cartItems as $product_id => $cartItem)
                        <div class="products-list-order row">
                            <div class="product-order-img col-md-2 text-center">
                                <img height="100" src="{{ asset(Storage::url($cartItem['avatar'])) }}" alt="">
                            </div>
                            <div class="product-order-info col-md-10">
                                <p class="product-name-order fw-bold">{{ $cartItem['product_name'] }}</p>
                                <div class="product-price-order">
                                    <div class="box-price d-flex justify-content-between">
                                        <p class="product-price-show fw-bold">{{ number_format($cartItem['price']) . '₫' }}</p>
                                        <p class="product-quantity-show">Số lượng: <span class="text-danger fw-bold">{{ $cartItem['quantity'] }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button id="show-more-btn">Xem thêm</button>
            </div>
            
            <h5>THÔNG TIN KHÁCH HÀNG</h5>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="order-form">
                        <form id="order-form" action="{{ route('client.cart.orderProcess') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="name" class="form-label">Họ và tên (bắt buộc)</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ và tên" value="{{ Auth::user()->full_name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="telephone" class="form-label">Số điện thoại (bắt buộc)</label>
                                    <input type="tel" name="phone" id="telephone" class="form-control" placeholder="Nhập số điện thoại" value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <div class="total-box d-flex justify-content-between align-items-center">
                        <p class="fw-bold fs-4">Tổng tiền: </p>
                        <p class="total text-danger fw-bold fs-5">{{ number_format($total_price) . '₫' }}</p>
                    </div>
                    <a class="btn btn-primary col-12" href="javascript:void(0);" id="confirmButton">Xác nhận</a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var showMoreBtn = $('#show-more-btn');
            var orderList = $('#order-list');

            showMoreBtn.click(function() {
                var currentHeight = orderList.css('max-height');
                if (currentHeight === '115px') {
                    orderList.css('max-height', '300px'); // Hoặc chiều cao tùy chọn
                    showMoreBtn.text('Thu gọn');
                } else {
                    orderList.css('max-height', '115px');
                    showMoreBtn.text('Xem thêm');
                }
            });

            $('#confirmButton').click(function() {
                var formData = $('#order-form').serialize();
                let routeOrder = '{{ route('client.cart.orderProcess') }}';
                $.ajax({
                    type: 'POST',
                    url: routeOrder,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.message == 'success') {
                            if(alert('Đặt thành công')) {
                                window.location.href = "{{ route('client.home') }}";
                            }
                        }
                    },
                    error: function(error) {
                        alert('Thất bại');
                    }
                });
            });
        });
    </script>
@endpush