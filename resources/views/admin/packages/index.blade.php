@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Packages</h1>

    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">Add Package</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->price }}</td>
                <td>
                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection