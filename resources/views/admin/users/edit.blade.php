@extends('layouts.admin.master')
@section('content')
    <div class="edit-form card w-50 mx-auto">
        <div class="card-body">
            <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}">
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}">
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="mb-2">Gender</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="gender" value="1" class="form-check-input" checked {{ $user->gender == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="gender" value="0" class="form-check-input" {{  $user->gender == '0' ? 'checked' : '' }}>
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" value="{{ $user->birthdate }}">
                    @error('birthdate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="tel" class="form-label">Phone</label>
                    <input type="tel" name="phone" id="tel" class="form-control" value="{{ $user->phone }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button text-center">
                    <button class="btn btn-secondary">Edit</button>
                </div>  
            </form>
        </div>
    </div>
@endsection