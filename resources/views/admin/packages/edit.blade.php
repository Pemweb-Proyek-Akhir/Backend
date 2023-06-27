@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Package</h1>

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $package->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $package->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Package</button>
    </form>
</div>
@endsection