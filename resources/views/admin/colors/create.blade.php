@extends('layouts.admin.master')
@section('content')
    <div class="create-content card w-50 mx-auto">
        <div class="create-form card-body">
            <form id="form-create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="color_name" class="form-label">Tên màu sắc</label>
                    <input type="text" name="color_name" id="color_name" class="form-control" placeholder="Nhập tên màu sắc" value="{{ old('color_name') }}">
                    <span class="text-danger" id="error-message"></span>
                </div>
                <div class="create-button">
                    <button class="create-btn btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const routeAddColor = "{{ route('admin.colors.storeAPI') }}";
        const routeIndex = "{{ route('admin.colors.index') }}";
    </script>
    <script src="{{ asset('js/admin/colors/store.js') }}"></script>
@endpush