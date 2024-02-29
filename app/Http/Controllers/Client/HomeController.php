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
        $keyword = $request->input('search-product');
        // dd($keyword);
        $keySearch = $request->get('search-product');
        // dd($keySearch);
        $products = Product::query()->where('name', 'LIKE', '%' . $keySearch . '%')->paginate(8);
        // dd($products);
        $products->appends(['search-product' => $keyword]);

        $manufacturers = Manufacturer::all();
        return view('client.index', [
            'products' => $products,
            'manufacturers' => $manufacturers
        ]);
    }

    public function filterProductsByManufacturer($manufacturerSlug)
    {
        // dd($manufacturerSlug);
        $manufacturers = Manufacturer::all();
        $manufacturer = Manufacturer::query()->where('name', $manufacturerSlug)->first();
        $products = Product::query()->where('manufacturer_id', $manufacturer->id)->paginate(18);

        // return response()->json(['message' => 'success', 'data' => $products], 200);
        return view('client.filter-products', [
            'manufacturers' => $manufacturers,
            'products' => $products
        ]);
    }

    // public function showProductDetail($id)
    // {
    //     $product = Product::where('id', $id)->first();
    //     return view('client.product-detail', [
    //         'product' => $product
    //     ]);
    // }

    public function showProductDetailBySlug($slug)
    {
        $product = Product::where('slug', $slug)->first();
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
