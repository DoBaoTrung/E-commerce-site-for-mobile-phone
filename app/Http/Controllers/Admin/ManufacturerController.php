<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Http\Requests\admin\manufacturers\StoreManufacturersRequest;
use App\Http\Requests\admin\manufacturers\UpdateManufacturersRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use PragmaRX\Countries\Package\Countries;
// use Intervension\Image\ImageManager;
// use Intervention\Image\Drivers\Imagick\Driver;

class ManufacturerController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Manufacturer();

        $currentRoute = Route::currentRouteName();
        // dd($currentRoute);
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = $this->model->query()->paginate(2);
        return view('admin.manufacturers.index', [
            'manufacturers' => $manufacturers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = new Countries();

        $countriesList = $countries->all()
        ->pluck('name.common', 'cca2')
        ->sort();

        return view('admin.manufacturers.create', [
            'countries' => $countriesList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManufacturersRequest $request)
    {
        // dd($request);
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('avatars/manufacturers', $request->file('avatar'));
            $request['avatar'] = $path;
        }
        // dd($request);
        $ckeditorContent = strip_tags($request->get('description'));
        $this->model->query()->create([
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar'),
            'national' => $request->get('national'),
            'description' => $ckeditorContent
        ]);
        return redirect()->route('admin.manufacturers.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        $data = $this->model->query()->where('id', $manufacturer->id)->firstOrFail();
        return view('admin.manufacturers.edit', [
            'manufacturer' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManufacturersRequest $request, Manufacturer $manufacturer)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('avatars/manufacturers', $request->file('avatar'));
            $request['avatar'] = $path;
        }

        $ckeditorContent = strip_tags($request->get('description'));
        $this->model->query()->where('id', $manufacturer->id)->update([
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar'),
            'national' => $request->get('national'),
            'description' => $ckeditorContent
        ]);
        return redirect()->route('admin.manufacturers.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($manufacturerId)
    {
        $this->model->query()->where('id', $manufacturerId)->delete();
        return redirect()->route('admin.manufacturers.index')->with('success', 'Xóa thành công');
    }
}
