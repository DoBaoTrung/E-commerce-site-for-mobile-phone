@extends('layouts.client.master')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h5 class="card-title">Kiểm tra đơn hàng</h5>
        </div>
        <div class="card-body">
            <div class="search-order mb-4">
                <form>
                    <h5 class="fw-bold">Tìm kiếm</h5>
                    <div class="input-group">
                        <input type="search" name="search-order" id="search-order" class="form-control"
                            placeholder="Tìm kiếm đơn hàng theo mã đơn hàng" value="{{ request('search-order') }}">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            @if ($order)
            <div class="search-order-result">
                <table class="table table-bordered text-center align-middle">
                        <thead class="table-warning">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người đặt</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Thời gian đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td>{{ $order->status_name }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td class="fw-bold">{{ number_format($order->total_price) . '₫' }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        </tbody>
                </table>
            </div>
            @elseif (request()->has('search-order') && empty(request('search-order')))
                <p class="d-flex justify-content-center">Không tìm thấy kết quả</p>
            @endif
        </div>
    </div>
@endsection
