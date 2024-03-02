@extends('layouts.admin.master')
@section('content')
    <div class="capacity-content card">
        <div class="card-body">
            <a class="btn btn-success mb-3" href="{{ route('admin.storageCapacities.create') }}">Add</a>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Capacity</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="capacity-content">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Lấy dữ liệu về
            function getData() {
                let route = '{{ route('admin.storageCapacities.indexAPI') }}'
                $.ajax({
                    type: "GET",
                    url: route,
                    data: "",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            // console.log(response);
                            let data = Array.from(response.data).map((record) => {
                                return `
                                    <tr>
                                        <td class="align-middle">${record.id}</td>
                                        <td class="align-middle fw-bold">${record.capacity}</td>
                                        <td class="align-middle">
                                            <a class="btn-edit btn btn-success" href="javascript:void(0)" data-id="${record.id}">Edit</a>
                                        </td>
                                        <td class="align-middle">
                                            <form id="form-${record.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete btn btn btn-danger" data-id="${record.id}">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                            });

                            $('#capacity-content').html(data.join(''));
                        }
                    }
                });
            }

            function deleteOneCapacity(capacityId) {
                let route = '{{ route('admin.storageCapacities.destroyAPI', ['capacityId' => ':capacityId']) }}'
                    .replace(':capacityId', capacityId);
                let form = "#form-id".replace('id', capacityId);
                // console.log($(form).serialize());
                $.ajax({
                    type: "DELETE",
                    url: route,
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            alert('Xóa thành công');
                            getData();
                        }
                    }
                });
            }

            // Đoạn mã được tải trước khi dữ liệu kịp trả về mà và ghi nhận cây DOM cũ tức chưa có dữ liệu mới được gắn vào.
            $('#capacity-content').on('click', '.btn-delete', function(event) {
                event.preventDefault();
                if (confirm('Are you sure you want to delete this capacity?')) {
                    let capacityId = $(this).data('id');
                    deleteOneCapacity(capacityId);
                }
            });

            getData();

            // Edit
            $('#capacity-content').on('click', '.btn-edit', function(event) {
                let capacityId = $(this).data('id');
                let routeEdit = "{{ route('admin.storageCapacities.edit', ['capacityId' => ':capacityId']) }}".replace(':capacityId', capacityId);
                window.location.href = routeEdit;
            });
        });
    </script>
@endpush
