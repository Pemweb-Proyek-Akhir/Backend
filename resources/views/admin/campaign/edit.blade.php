<!-- resources/views/campaign/edit.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Campaign</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $campaign->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required>{{ $campaign->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="target">Target:</label>
            <input type="text" name="target" id="target" class="form-control" value="{{ $campaign->target }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ $campaign->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $campaign->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="current">Current:</label>
            <input type="number" name="current" id="current" class="form-control" value="{{ $campaign->current }}" required>
        </div>

        <div class="form-group">
            <label for="packages">Packages</label>
            <select name="packages[]" id="packages" class="form-control" multiple required>
                @foreach ($packages as $package)
                <option value="{{ $package->id }}" @if ($campaign->packages->contains($package->id)) selected @endif>{{ $package->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Banner Form -->
        <div class="form-group">
            <label for="banner_urls">Banner URLs:</label>
            @foreach ($campaign->banners as $banner)
            <input type="text" name="banner_urls[]" class="form-control" value="{{ $banner->url }}" required>
            @endforeach
        </div>

        <div id="banner-inputs-container"></div>

        <button type="button" class="btn btn-primary" onclick="addBannerInput()">Add Banner</button>

        <button type="submit" class="btn btn-primary">Update Campaign</button>
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