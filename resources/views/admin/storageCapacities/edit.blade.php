@extends('layouts.admin.master')
@section('content')
    <div class="edit-content card w-50 mx-auto">
        <div class="edit-form card-body">
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-label">Capacity</label>
                    <input type="text" name="capacity" id="name" class="form-control" placeholder="Enter capacity"
                        value="{{ $capacity->capacity }}">
                    <span id="error-message" class="text-danger"></span>
                </div>
                <div class="button-edit">
                    <button class="edit-btn btn btn-primary" data-id="{{ $capacity->id }}">Edit</button>
                </div>
            </form>
            <div id="paginate"></div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const capacityId = document.querySelector('.edit-btn').getAttribute('data-id');
        const routeUpdate = "{{ route('admin.storageCapacities.updateAPI', ['capacityId' => ':capacityId']) }}".replace(":capacityId", capacityId);
        const routeHome = "{{ route('admin.storageCapacities.index') }}";
    </script>
    <script src="{{ asset('js/admin/capacity/update.js') }}"></script>
@endpush
