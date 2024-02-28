<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Order();
        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);

        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        $orders = $this->model->query()->with('user')->get();
        // dd($orders);
        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function approve($orderId)
    {
        $order = $this->model->query()->where('id', $orderId)->firstOrFail();
        // dd($order);

        $order->status = 1;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật');
    }

    public function cancel($orderId)
    {
        $order = $this->model->query()->where('id', $orderId)->firstOrFail();
        // dd($order);

        $order->status = 2;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật');
    }

    public function show($orderId)
    {
        // dd($orderId);
        $order = $this->model->query()->where('id', $orderId)->with('user')->firstOrFail();
        // dd($order);

        $orderDetails = DB::table('order_details')
        ->select(
            'order_details.order_id',
            'order_details.quantity',
            'order_details.unit_price',
            'products.*'
        )
        ->join('products', 'products.id', '=', 'order_details.product_id')
        ->where('order_details.order_id', $order->id)
        ->get();

        // dd($orderDetails);

        $orderInfo = DB::table('order_details')
        ->select(
            'order_details.address_receiver',
        )
        ->where('order_details.order_id', $order->id)->first();

        return view('admin.orders.order-detail', [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'orderInfo' => $orderInfo
        ]);
    }
}