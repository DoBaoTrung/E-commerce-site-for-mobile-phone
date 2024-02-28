@extends('layouts.client.master')
@section('content')
    <div class="register-form w-50 mx-auto border border-2 rounded-2 p-4 bg-white shadow">
        <h4 class="text-center">Đăng ký tài khoản</h4>
        <form action="{{ route('client.processRegister') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="first_name" class="form-label">First name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="mb-2">Gender</label>
                <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">Male</label>
                    <input type="radio" name="gender" value="1" class="form-check-input" checked {{ old('gender') == '1' ? 'checked' : '' }}>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">Female</label>
                    <input type="radio" name="gender" value="0" class="form-check-input" {{ old('gender') == '0' ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Birthdate</label>
                <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
                @error('birthdate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="tel" class="form-label">Phone</label>
                <input type="tel" name="phone" id="tel" class="form-control" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="confirm_password" class="form-label">Confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                @error('confirm_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="button text-center">
                <button class="btn btn-secondary">Register</button>
            </div>
        </form>
    </div>
@endsection