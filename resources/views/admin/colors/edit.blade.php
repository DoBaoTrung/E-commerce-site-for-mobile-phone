@extends('layouts.admin.master')
@section('content')
    <div class="edit-content card w-50 mx-auto">
        <div class="edit-form card-body">
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="color_name" class="form-label">Tên màu sắc</label>
                    <input type="text" name="color_name" id="color_name" class="form-control" placeholder="Nhập tên màu sắc" value="{{ $color->color_name }}">
                    <span id="error-message" class="text-danger"></span>
                </div>
                <div class="edit-button">
                    <button class="edit-btn btn btn-primary" data-id="{{ $color->id }}">Sửa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let colors = @json($colors);
        let arrColor = [];
        for (let item of colors) {
            arrColor.push(item.color_name);
        }
        // console.log(arrColor);
        let arrayColor = arrColor.filter((record) => {
            return record != @json($color->color_name);
        });
        // console.log(arrayColor);
        
        let routeUpdateColor = "{{ route('admin.colors.updateAPI', ['colorId' => ':colorId']) }}".replace(':colorId', document.querySelector('.edit-btn').dataset.id);
        let routeIndex = "{{ route('admin.colors.index') }}";
    </script>
    <script src="{{ asset('js/admin/colors/update.js') }}"></script>
@endpush