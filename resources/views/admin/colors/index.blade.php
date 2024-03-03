@extends('layouts.admin.master')
@section('content')
    <div class="colors-content card">
        <div class="colors-table card-body">
            <a class="btn btn-success mb-3" href="{{ route('admin.colors.create') }}">Add</a>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Color name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="colors-body">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function getData(routeGetData) {
            fetch(routeGetData, {
                method: "GET",
                headers: {
                    Accept: "application/json, text/html",
                    "Content-Type": "application/json"
                }
            })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                // console.log(data);
                if(data.status === 'success') {
                    let content = document.getElementById('colors-body');
                    let render = Array.from(data.data).map((record) => {
                        let routeEdit = "{{ route('admin.colors.edit', ['colorId' => ':colorId']) }}".replace(':colorId', record.id);
                        return `
                            <tr>
                                <td class="align-middle">${record.id}</td>
                                <td class="align-middle">${record.color_name}</td>
                                <td class="align-middle">
                                    <a class="btn btn-success" href="${routeEdit}">Edit</a>
                                </td>
                                <td class="align-middle">
                                    <form id="delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn btn btn-danger" data-id="${record.id}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                    content.innerHTML = render.join(' ');
                }
            })
        }

        function deleteColor(colorId, routeGetData)
        {
            const routeDelete = "{{ route('admin.colors.destroyAPI', ['colorId' => ':colorId']) }}".replace(':colorId', colorId);
            const csrfToken = document.querySelector('input[name="_token"]').value;
            fetch(routeDelete, {
                method: 'DELETE',
                headers: {
                    Accept: 'application/json, text/html; charset=utf-8',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    '_token': csrfToken
                })
            })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                if (data.status === 'success') {
                    alert("Xóa màu thành công");
                    getData(routeGetData);
                }
            })
        }
        
        document.addEventListener("DOMContentLoaded", function() {
            const routeGetData = "{{ route('admin.colors.indexAPI') }}";
            getData(routeGetData);
            
            let colorsBody = document.getElementById('colors-body');
            colorsBody.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-btn')) {
                    event.preventDefault();
                    if (confirm("Bạn có chắc muốn xóa màu này không?")) {
                        const colorId = event.target.dataset.id;
                        // console.log(colorId);
                        deleteColor(colorId, routeGetData);
                    }
                }
            });
        });

    </script>
@endpush