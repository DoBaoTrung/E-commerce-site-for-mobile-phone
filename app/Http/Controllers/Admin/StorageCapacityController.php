<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\storageCapacities\StoreCapacityRequest;
use App\Http\Requests\admin\storageCapacities\UpdateCapacityRequest;
use App\Models\StorageCapacity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class StorageCapacityController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new StorageCapacity();
        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        return view('admin.storageCapacities.index');
    }

    public function create()
    {
        return view('admin.storageCapacities.create');
    }

    public function edit($capacityId)
    {
        $capacity = $this->model->query()->where('id', $capacityId)->first();
        return view('admin.storageCapacities.edit', [
            'capacity' => $capacity,
        ]);
    }

    // public function update(UpdateCapacityRequest $request, $capacityId)
    // {
    //     $this->model->query()->where('id', $capacityId)->update($request->validated());
    //     return redirect()->route('admin.storageCapacities.index');
    // }

    public function getData()
    {
        try {
            $capacities = $this->model->all();
            if ($capacities) {
                return response()->json(['status' => 'success', 'data' => $capacities], 200);
            }
            throw new \Exception('Can not take data from database');
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 503);
        }
    }

    public function addCapacity(StoreCapacityRequest $request)
    {
        try {
            $capacity = $this->model->create($request->validated());
            if(!$capacity) {
                throw new \Exception('Add failed');
            }
            
            return response()->json(['status' => 'success'], 200);
        }
        catch (\Throwable $e) {
            return response()->json(['status' =>'fail', 'error' => $e->getMessage()], 403);
        }
    }

    public function updateCapacity(UpdateCapacityRequest $request, $capacityId)
    {
        try {
            $updated = $this->model->where('id', $capacityId)->update($request->validated());
            if ($updated > 0) {
                return response()->json(['status' => 'success'], 200);
            }
            throw new \Exception('Record not found!');
        }
        catch (\Throwable $e) {
            return response()->json(['status' =>'fail', 'error' => $e->getMessage()], 403);
        }
    }

    public function destroyCapacity($capacityId) {
        $this->model->query()->where('id', $capacityId)->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
