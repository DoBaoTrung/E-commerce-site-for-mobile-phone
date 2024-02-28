<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\products\StoreProductRequest;
use App\Http\Requests\admin\products\UpdateProductRequest;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Contracts\Cache\Store;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Product();
        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        $products = $this->model->query()->with('manufacturer')->paginate(2);
        // dd($products);
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.products.create', [
            'manufacturers' => $manufacturers
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('avatars/products', $request->file('avatar'));
            $request['avatar'] = $path;
        }
        $ckeditor = strip_tags($request->get('description'));
        $this->model->query()->create([
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar'),
            'price' => $request->get('price'),
            'description' => $ckeditor,
            'manufacturer_id' => $request->get('manufacturer_id')
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Tạo thành công');
    }

    public function edit($productId)
    {
        $product = $this->model->query()->where('id', $productId)->first();
        $manufacturers = Manufacturer::all();
        return view('admin.products.edit', [
            'product' => $product,
            'manufacturers' => $manufacturers
        ]);
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('avatars/products', $request->file('avatar'));
            $request['avatar'] = $path;
        }

        $ckeditor = strip_tags($request->get('description'));
        $this->model->query()->where('id', $productId)->update([
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar'),
            'price' => $request->get('price'),
            'description' => $ckeditor,
            'manufacturer_id' => $request->get('manufacturer_id')
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Updated successfully');
    }

    public function destroy($productId)
    {
        // dd($productId);
        $this->model->query()->where('id', $productId)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Delete successfully');
    }
}
