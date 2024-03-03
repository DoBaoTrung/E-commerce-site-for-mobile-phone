<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\colors\StoreColorRequest;
use App\Http\Requests\admin\colors\UpdateColorRequest;
use App\Models\Color;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use function PHPUnit\Framework\returnSelf;

class ColorController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Color();

        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        return view('admin.colors.index');
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function edit($colorId)
    {
        $color = $this->model->query()->where('id', $colorId)->first();
        $colors = $this->model->all();
        return view('admin.colors.edit', [
            'colors' => $colors,
            'color' => $color
        ]);
    }

    public function getData()
    {
        try {
            $colors = $this->model->all();
            
            if (!$colors) {
                throw new Exception('Thất bại trong việc lấy dữ liệu');
            }

            return response()->json(['status' => 'success', 'data' => $colors], 200);
        }
        catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 403);
        }
    }

    public function addColor(StoreColorRequest $request)
    {
        try {
            $color = $this->model->create($request->validated());
            if (!$color) {
                throw new Exception('Thêm màu thất bại');
            }
            return response()->json(['status' => 'success'], 200);
        }
        catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 403);
        }   
    }

    public function updateColor(UpdateColorRequest $request, $colorId)
    {
        try {
            $updated = $this->model->query()->where('id', $colorId)->update($request->validated());
            if ($updated > 0) {
                return response()->json(['status' => 'success'], 200);
            }
            throw new Exception('Lỗi cập nhật màu sắc');
        }
        catch (\Throwable $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 403);
        }
    }

    public function deleteColor($colorId)
    {
        try {
            $delete = $this->model->query()->where('id', $colorId)->delete();
            if ($delete > 0) {
                return response()->json(['status' => 'success'], 200);
            }
            throw new Exception('Lỗi xóa màu');
        }
        catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 403);
        }
    }
}
