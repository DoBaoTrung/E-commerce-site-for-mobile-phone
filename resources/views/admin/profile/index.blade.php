@extends('layouts.admin.master')
@section('content')
    <div class="profile-form">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <img style="height: 150px;" class="profile-admin-img img-fluid img-circle elevation-2" src="{{ asset(Storage::url(Auth::guard('admin')->user()->avatar)) }}" alt="">
                        </div>
                        <h3 class="profile-admin-name text-center">{{ ucfirst(Auth::guard('admin')->user()->name) }}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email: </b>
                                <p class="float-right my-0">{{ Auth::guard('admin')->user()->email }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header card-primary">
                        <h4 class="card-title">Cập nhật thông tin</h4>
                    </div>
                    <div class="card-body form-update-profile">
                        <form action="{{ route('admin.profile.update', ['admin' => Auth::guard('admin')->user()->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                                @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="button-update-profile">
                                <button class="btn-update-profile-admin btn btn-primary" data-id="{{ Auth::guard('admin')->user()->id }}">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('js')
    <script>
        
    </script>
@endpush --}}