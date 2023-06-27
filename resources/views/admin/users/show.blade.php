@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <p class="card-text">User Type: {{ $user->user_type == 1 ? 'Admin' : 'Customer' }}</p>
            <p class="card-text">Created At: {{ $user->created_at }}</p>
            <p class="card-text">Updated At: {{ $user->updated_at }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
        </form>
    </div>
</div>
@endsection