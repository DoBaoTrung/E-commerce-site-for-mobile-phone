@extends('layouts.client.master')
@section('content')
    <div class="forgot-password-form w-50 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Quên mật khẩu</h5>
            </div>
            <div class="card-body">
                @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email">
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="forgot-password-button">
                        <button class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection