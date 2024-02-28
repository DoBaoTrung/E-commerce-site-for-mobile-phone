@extends('layouts.admin.master')
@section('content')
    <div class="orders-table card">
        <div class="card-body">
            <div class="delete-order mb-3 text-end">
                {{-- <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Xóa</button>
                </form> --}}
            </div>
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Payment_method</th>
                        <th>Total price</th>
                        <th>Order date</th>
                        <th>Duyệt</th>
                        <th>Hủy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-start">
                                <a href="{{ route('admin.orders.show', ['orderId' => $order->id]) }}">
                                    {{ $order->id }}
                                </a>
                            </td>
                            <td>{{ $order->user->email }}</td>
                            <td>
                                @if ($order->status === 0)
                                    {{ $order->status_name }}
                                @elseif ($order->status === 1)
                                    {{ $order->status_name }}
                                @else
                                    {{ $order->status_name }}
                                @endif
                            </td>
                            <td></td>
                            <td>{{ number_format($order->total_price) . '₫' }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.orders.approve', ['orderId' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button id="approveBtn" class="btn btn-success">Duyệt</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.cancel', ['orderId' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button id="cancelBtn" class="btn btn-danger">Hủy</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection