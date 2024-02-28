<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\profile\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Admin();
        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }
    public function index()
    {
        return view('admin.index'); 
    }

    public function profile()
    {
        // dd(Auth::guard('admin'));
        return view('admin.profile.index');
    }

    public function update($adminId, UpdateProfileRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->put('avatars/profile', $request->file('avatar'));
            $request['avatar'] = $path;
        }

        $this->model->query()->where('id', $adminId)->update([
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar')
        ]);
        return redirect()->route('admin.profile.index', ['admin' => $adminId]);
    }

    // API Update Profile Admin
    public function updateProfileAPI($adminId, UpdateProfileRequest $request) {
        return response()->json(['success', 'Thành công']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
