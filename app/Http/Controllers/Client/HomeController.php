<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keySearch = $request->get('search-product');
        // dd($keySearch);
        $products = Product::query()->where('name', 'LIKE', '%' . $keySearch . '%')->get();
        $manufacturers = Manufacturer::all();
        return view('client.index', [
            'products' => $products,
            'manufacturers' => $manufacturers
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('client.product-detail', [
            'product' => $product
        ]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        // session()->regenerateToken();
        return redirect()->route('client.home');
    }
}
