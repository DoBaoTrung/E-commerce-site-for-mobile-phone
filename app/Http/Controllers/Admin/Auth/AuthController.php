<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\auth\CheckLoginRequest;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function processLogin(CheckLoginRequest $request)
    {
        // dd($request);
        if (Auth::guard('admin')->attempt($request->validated())) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('admin.login')->with('error', 'Tài khoản và mật khẩu không đúng');
    }
}
