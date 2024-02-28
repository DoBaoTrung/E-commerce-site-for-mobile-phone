<?php

namespace App\Http\Controllers\Client\Auth;

use App\Events\client\auth\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\client\auth\CheckLoginRequest;
use App\Http\Requests\client\auth\CheckRegisterRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function processLogin(CheckLoginRequest $request)
    {
        try {
            // $user = User::query()->where('email', $request->get('email'))->firstOrFail();
            $remember = $request->has('remember');

            if (!Auth::attempt($request->only('email', 'password'), $remember)) {
                throw new \Exception('Error login');
            }
            return response()->json(['message' => 'Đăng nhập thành công', 'status' => 'success', 'user' => Auth::user()], 200);
            
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Tài khoản và mật khẩu không đúng', 'status' => 'error'], 401);
        }
    }

    public function register()
    {
        return view('client.auth.register');
    }

    public function processRegister(CheckRegisterRequest $request)
    {
        $user = User::create($request->except(['_token', 'confirm_password']));
    
        Cart::create([
            'user_id' => $user->id,
        ]);

        UserRegisterEvent::dispatch($user);
        return redirect()->route('client.home')->with('success', 'Tài khoản đã được tạo thành công');
    }
}
