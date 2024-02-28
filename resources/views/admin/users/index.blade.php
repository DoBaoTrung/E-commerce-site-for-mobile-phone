@extends('layouts.admin.master')
@section('content')
    <div class="users-table card">
        <div class="card-body">
            <a class="col-1 btn btn-success" href="{{ route('admin.users.create') }}">Add user</a>
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-striped table-hover mt-3 text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="users-table-content">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name  }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender_name }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination mt-3 d-flex justify-content-center">
                {{ $users->links()}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.addEventListener('click', function(event) {
        //     });

        //     showUsers();

        //     function showUsers() {
        //         let content = document.querySelector('.users-table-content');
        //         let route = '{{ route('admin.users.indexAPI') }}'
        //         fetch(route)
        //             .then(function(response) {
        //                 return response.json();
        //             })
        //             .then(function(data) {
        //                 var users = Array.from(data.data).map((user) => {
        //                     return `
        //                         <tr>
        //                             <td>${user.id}</td>
        //                             <td>${user.full_name}</td>
        //                             <td>${user.email}</td>
        //                             <td>${user.gender_name}</td>
        //                             <td>${user.age}</td>
        //                             <td>${user.phone}</td>
        //                             <td>${user.address}</td>
        //                             <td>
        //                                 <a class="btn btn-primary" href="">Edit</a>
        //                             </td>
        //                             <td>
        //                                 <form action="" method="POST">
        //                                     @csrf
        //                                     @method('DELETE')
        //                                     <button class="btn btn-danger">Delete</button>
        //                                 </form>
        //                             </td>
        //                         </tr>
        //                     `;
        //                 });
        //                 content.innerHTML = users.join('');
        //             })
        //             .catch(function(error) {
        //                 alert(error);
        //             })

        //     }
        // });
        // $(document).ready(function() {
        //     var content = $('.users-table-content');
        //     $.ajax({
        //         url: '{{ route('admin.users.indexAPI') }}',
        //         type: "GET",
        //         dataType: "json",
        //         data: "",
        //         success: function(data) {
        //             console.log(data);
        //             let users = Array.from(data[0].data).map((user) => {
        //                 return `
        //                 <tr>
        //                     <td>${user.id}</td>
        //                     <td>${user.full_name}</td>
        //                     <td>${user.email}</td>
        //                     <td>${user.gender_name}</td>
        //                     <td>${user.age}</td>
        //                     <td>${user.phone}</td>
        //                     <td>${user.address}</td>
        //                     <td>
        //                         <a class="btn btn-primary" href="">Edit</a>
        //                     </td>
        //                     <td>
        //                         <form action="" method="POST">
        //                             @csrf
        //                             @method('DELETE')
        //                             <button class="btn btn-danger">Delete</button>
        //                         </form>
        //                     </td>
        //                 </tr>
        //             `;
        //             });
        //             content.html(users.join(''));
        //         }
        //     });
        // });
    </script>
@endpush