@extends('layouts.admin.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ckeditor.css') }}">
@endpush
@section('content')
    <div class="edit-form card w-50 mx-auto">
        <div class="card-body">
            <form action="{{ route('admin.manufacturers.update', ['manufacturer' => $manufacturer->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $manufacturer->name }}">
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
                    <label for="national" class="form-label">National</label>
                    <input type="text" name="national" id="national" class="form-control"
                        value="{{ $manufacturer->national }}">
                    @error('national')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="editor" class="form-label">Description</label>
                    <textarea name="description" id="editor" class="form-control custom-textarea">{{ $manufacturer->description }}</textarea>
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
