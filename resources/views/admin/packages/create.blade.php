@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Package</h1>

    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Package</button>
    </form>
</div>
@endsection