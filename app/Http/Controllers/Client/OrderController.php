<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('client.view-order');
    }

    public function checkoutOrder(Request $request)
    {
        $order = Order::where('id', $request->input('search-order'))->with('user')->first();
        // dd($order);
        return view('client.check-order', [
            'order' => $order
        ]);
    }
}
