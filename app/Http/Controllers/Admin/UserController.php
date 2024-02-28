<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\users\StoreUserRequest;
use App\Http\Requests\admin\users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// use Illuminate\Http\Request;

class UserController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new User();
        
        $currentRoute = Route::currentRouteName();
        $arr = explode('.', $currentRoute);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        $users = $this->model->query()->paginate(2);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function indexAPI()
    {
        $users = $this->model->query()->paginate(2);
        return response()->json([$users], 200);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request);
        $this->model->query()->create($request->except(['_token', 'confirm_password']));
        return redirect()->route('admin.users.index')->with('success', 'Thêm thành công');
    }

    public function edit(User $user)
    {
        // dd($user);
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request);
        $this->model->query()->where('id', $user->id)->update($request->validated());
        return redirect()->route('admin.users.update')->with('success', 'Sửa thành công');
    }

    public function destroy($userId)
    {
        $this->model->query()->where('id', $userId)->delete();
        return redirect()->route('admin.users.destroy')->with('success', 'Xóa thành công');
    }
}
