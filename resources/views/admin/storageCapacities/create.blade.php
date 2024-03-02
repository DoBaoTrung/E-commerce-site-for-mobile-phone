@extends('layouts.admin.master')
@section('content')
    <div class="create-content card w-50 mx-auto">
        <div class="create-form card-body">
            <form id="form-create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Capacity</label>
                    <input type="text" name="capacity" id="name" class="form-control" placeholder="Enter capacity">
                    <span class="text-danger" id="capacity-error"></span>
                </div>
                <div class="button-create">
                    <button class="add-btn btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let addBtn = document.querySelector('.add-btn');
            let errorMessage = document.getElementById('capacity-error');
            let input = document.querySelector('input[name="capacity');

            input.addEventListener('focus', function() {
                errorMessage.innerHTML = '';
            });

            input.addEventListener('keydown', function() {
                errorMessage.innerHTML = '';
            });

            addBtn.addEventListener('click', function(event) {
                event.preventDefault();
                let csrfToken = document.querySelector('input[name="_token"]').value;
                // let form = document.getElementById('form-create');
                // let formData = new FormData(form);
                let capacity = document.getElementById('name').value;
                fetch('{{ route('admin.storageCapacities.storeAPI') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json, text/html',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        'capacity': capacity,
                        '_token': csrfToken
                    })
                })
                .then((response) => {
                    // console.log(response);
                    // if (!response.ok || response.headers.get('content-type') !== 'application/json') {
                    //     throw new Error('Invalid JSON response');
                    // }
                    return response.json();
                })
                .then((data) => {
                    if (data.status === 'success') {
                        alert('Thêm thành công');
                        window.location.href = "{{ route('admin.storageCapacities.index') }}";
                    } else {
                        errorMessage.innerHTML = data.message;
                    }
                })
                .catch((error) => {
                    alert('Thất bại');
                });
            });
        });
    </script>
@endpush
