@extends('layouts.admin.master')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Thông tin đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group" style="list-style: none;">
                                <li>Mã</li>
                                <li>Ngày tạo</li>
                                <li>Trạng thái đơn hàng</li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group text-end fw-bold" style="list-style: none;">
                                <li>{{ $order->id }}</li>
                                <li>{{ $order->created_at }}</li>
                                <li>{{ $order->status_name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-credit-card mr-2"></i>
                        Phương thức thanh toán
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="list-group" style="list-style: none;">
                                <li>Thanh toán khi nhận hàng</li>
                                <li>Trạng thái thanh toán</li>
                            </ul>
                        </div>
                        <div class="col-md-7">
                            <ul class="list-group text-end fw-bold" style="list-style: none;">
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Chi tiết đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $orderDetail)
                                <tr>
                                    <td>
                                        <img height="100" src="{{ asset(Storage::url($orderDetail->avatar)) }}" alt="product-img">
                                    </td>
                                    <td>{{ $orderDetail->name }}</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td class="fw-bold">{{ number_format($orderDetail->price) . '₫' }}</td>
                                    <td class="fw-bold">{{ number_format($orderDetail->unit_price) . '₫' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Tổng tiền đơn hàng: {{ number_format($order->total_price) . '₫' }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-id-card mr-2"></i>
                        Thông tin người mua
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="list-group" style="list-style: none;">
                                <li>Họ tên</li>
                                <li>Số điện thoại</li>
                                <li>Email</li>
                            </ul>
                        </div>
                        <div class="col-md-7">
                            <ul class="list-group text-end fw-bold" style="list-style: none;">
                                <li>{{ $order->user->full_name }}</li>
                                <li>{{ $order->user->phone }}</li>
                                <li>{{ $order->user->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-location-arrow mr-2"></i>
                        Địa chỉ nhận hàng
                    </h5>
                </div>
                <div class="card-body">
                    {{ $orderInfo->address_receiver }}
                </div>
            </div>
        </div>
    </div>
@endsection