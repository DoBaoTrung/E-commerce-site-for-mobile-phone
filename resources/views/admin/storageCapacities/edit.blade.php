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
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let buttonEdit = document.querySelector('.edit-btn');
            let input = document.querySelector('input[name=capacity]');
            let errorMessage = document.getElementById('error-message');

            input.addEventListener('focus', function() {
                errorMessage.innerHTML = '';
            });

            input.addEventListener('keydown', function() {
                errorMessage.innerHTML = '';
            });

            buttonEdit.addEventListener('click', function(event) {
                event.preventDefault();
                if (input.value === "") {
                    errorMessage.innerHTML = 'Vui lòng nhập thông tin';
                } else {
                    const capacityId = event.target.dataset.id;
                    updateCapacity(capacityId);
                }
            });

            function updateCapacity(capacityId) {
                let route = "{{ route('admin.storageCapacities.updateAPI', ['capacityId' => ':capacityId']) }}"
                    .replace(':capacityId', capacityId)
                let csrfToken = document.querySelector('input[name=_token]').value;
                // let form = document.getElementById('form-edit');
                // let formData = new FormData(form);
                fetch(route, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json, text/html',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        'capacity': input.value,
                        '_token': csrfToken
                    })
                })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.status == 'success') {
                        alert('Sửa thành công');
                        window.location.href = "{{ route('admin.storageCapacities.index') }}";
                    }
                })
                .catch((error) => {
                    alert('Thất bại');
                })
            }
        });
    </script>
@endpush
