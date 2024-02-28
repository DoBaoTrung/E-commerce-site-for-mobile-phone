<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\CheckFormOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartItems = $cart->products()->get();

        $totalPrice = $this->calculateTotalPrice($cartItems);

        $cartView = [];
        foreach ($cartItems as $cartItem) {
            $product_id = $cartItem->pivot->product_id;
            $product = Product::find($product_id);
            $cartView[$product_id] = [
                'product_name' => $product->name,
                'slug' => $product->slug,
                'avatar' => $cartItem->pivot->avatar,
                'description' => $cartItem->pivot->description,
                'quantity' => $cartItem->pivot->quantity,
                'total_price' => $cartItem->pivot->total_price
            ];
        }
        // $cartView = collect();
        // foreach ($cartItems as $cartItem) {
        //     $product_id = $cartItem->pivot->product_id;
        //     $cartView->put($product_id, [
        //         'avatar' => $cartItem->pivot->avatar,
        //         'description' => $cartItem->pivot->description,
        //         'quantity' => $cartItem->pivot->quantity,
        //         'total_price' => $cartItem->pivot->total_price
        //     ]);
        // }
        // dd($cartView);

        return view('client.cart', [
            'cartItems' => $cartView,
            'totalPrice' => $totalPrice
        ]);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        // Kiểm tra xem giỏ hàng có tồn tại trong bảng trung gian hay không
        $exisitingCartItem = $cart->products()->where('product_id', $productId)->first();

        if ($exisitingCartItem) {
            $data = [
                'quantity' => $exisitingCartItem->pivot->quantity + 1,
                'total_price' => ($exisitingCartItem->pivot->quantity + 1) * $product->price
            ];
            $cart->products()->updateExistingPivot($productId, $data);
        } else {
            $data = [
                'cart_id' => $cart->id,
                'avatar' => $product->avatar,
                'description' => $product->description,
                'quantity' => 1,
                'total_price' => $product->price,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $cart->products()->attach($productId, $data);
        }

        return redirect()->route('client.product.show', ['slug' => $product->slug]);
    }

    public function calculateTotalPrice($cartItems)
    {
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->pivot->total_price;
        }

        return $totalPrice;
    }

    public function deleteOneProductInCart($productId)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if ($cart) {
            $cart->products()->detach($productId);
        }

        return redirect()->route('client.cart');
    }

    public function orderInfo()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartItems = $cart->products()->get();

        $totalPrice = $this->calculateTotalPrice($cartItems);

        $cartView = [];
        foreach ($cartItems as $cartItem) {
            $product_id = $cartItem->pivot->product_id;
            $product = Product::find($product_id);
            $cartView[$product_id] = [
                'product_name' => $product->name,
                'avatar' => $cartItem->pivot->avatar,
                'description' => $cartItem->pivot->description,
                'price' => $product->price,
                'quantity' => $cartItem->pivot->quantity,
                'total_price' => $cartItem->pivot->total_price
            ];
        }

        return view('client.order', [
            'cartItems' => $cartView,
            'total_price' => $totalPrice
        ]);
    }

    public function orderProcess(CheckFormOrderRequest $request)
    {
        try {
            // Lấy giỏ hàng của người dùng
            $cart = Cart::where('user_id', Auth::user()->id)->first();

            // Kiểm tra nếu giỏ hàng không tồn tại hoặc không có sản phẩm
            if (!$cart || $cart->products()->count() === 0) {
                throw new \Exception('Giỏ hàng trống');
            }

            // Lấy thông tin sản phẩm trong giỏ hàng
            $cartItems = $cart->products()->get();

            // Tính tổng giá trị đơn hàng
            $totalPrice = $this->calculateTotalPrice($cartItems);

            // Tạo đơn hàng mới
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_price' => $totalPrice
            ]);

            // Kiểm tra xem đơn hàng đã được tạo thành công hay không
            if (!$order) {
                throw new \Exception('Lỗi đặt hàng');
            }
            // dd($order);

            // Sử dụng transaction để đảm bảo tính toàn vẹn dữ liệu
            DB::beginTransaction();

            try {
                // Lặp qua từng sản phẩm trong giỏ hàng và tạo thông tin đơn hàng chi tiết
                foreach ($cartItems as $cartItem) {
                    $product_id = $cartItem->pivot->product_id;
                    $dataOrderDetail = [
                        'order_id' => $order->id->toString(),
                        'name_receiver' => $request->get('name'),
                        'phone_receiver' => $request->get('phone'),
                        'email_receiver' => $request->get('email'),
                        'address_receiver' => $request->get('address'),
                        'quantity' => $cartItem->pivot->quantity,
                        'unit_price' => $cartItem->pivot->total_price,
                    ];
                    // dd($dataOrderDetail);
                    // Thêm thông tin đơn hàng chi tiết vào bảng trung gian
                    $order->products()->attach($product_id, $dataOrderDetail);
                }

                // Xóa sản phẩm từ giỏ hàng
                $cart->products()->detach();

                // Commit transaction khi mọi thứ diễn ra thành công
                DB::commit();

                return redirect()->route('client.home')->with('success', 'Đặt thành công');
                // return response()->json(['message' => 'success'], 200);
            } catch (\Exception $exception) {
                // Rollback transaction nếu có lỗi xảy ra
                DB::rollBack();
                throw $exception; // Ném lại lỗi để xử lý ở layer khác (hoặc log)
            }
        } catch (\Throwable $e) {
            // Xử lý lỗi và trả về response
            return response()->json(['message' => 'error', 'error_message' => $e->getMessage()], 401);
        }
    }
}
