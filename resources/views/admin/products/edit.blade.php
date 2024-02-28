@extends('layouts.admin.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ckeditor.css') }}">
@endpush
@section('content')
    <div class="edit-form card w-50 mx-auto">
        <div class="card-body">
            <form id="editProductForm" action="{{ route('admin.products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" min="0" class="form-control" value="{{ $product->price }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor" class="form-label">Description</label>
                    <textarea name="description" id="editor" class="form-control custom-textarea">{{ $product->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Manufacturer</label>
                    <select name="manufacturer_id" class="form-select">
                        <option disabled selected>----- Select -----</option>
                        @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}"
                            @if ($product->manufacturer_id == $manufacturer->id)
                                selected
                            @endif    
                            >{{ $manufacturer->name }}</option>
                        @endforeach
                    </select>
                    @error('manufacturer_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush