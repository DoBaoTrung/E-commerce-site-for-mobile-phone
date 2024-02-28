@extends('layouts.admin.master')
@section('content')
    <div class="manufacturers-table card">
        <div class="card-body">
            <a class="col-1 btn btn-success" href="{{ route('admin.manufacturers.create') }}">Add</a>
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-striped mt-3 text-center">
                <thead class="table table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>National</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manufacturers as $manufacturer)
                        <tr>
                            <td class="align-middle">{{ $manufacturer->id }}</td>
                            <td class="align-middle">{{ $manufacturer->name }}</td>
                            <td class="align-middle">
                                @if ($manufacturer->avatar !== null)
                                    <img class="img-circle" height="100" src="{{ asset(Storage::url($manufacturer->avatar)) }}" alt="image">
                                @endif
                            </td>
                            <td class="align-middle">{{ $manufacturer->national }}</td>
                            <td class="align-middle">{{ $manufacturer->description }}</td>
                            <td class="align-middle">
                                <a class="btn btn-primary" href="{{ route('admin.manufacturers.edit', ['manufacturer' => $manufacturer->id]) }}">Edit</a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('admin.manufacturers.destroy', ['manufacturer' => $manufacturer->id]) }}" method="POST">
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
                {{ $manufacturers->links()}}
            </div>
        </div>
    </div>
@endsection
