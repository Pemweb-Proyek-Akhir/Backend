<!-- resources/views/campaign/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Campaign</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.campaign.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="target">Target:</label>
            <input type="text" name="target" id="target" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="current">Current:</label>
            <input type="number" name="current" id="current" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Campaign</button>
    </form>
</div>

<script>
    function addBannerInput() {
        const container = document.getElementById('banner-inputs-container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'banner_urls[]';
        input.className = 'form-control mt-2';
        container.appendChild(input);
    }
</script>
@endsection