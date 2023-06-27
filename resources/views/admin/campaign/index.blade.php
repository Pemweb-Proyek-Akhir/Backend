<!-- resources/views/campaign/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Campaign List</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary">Create Campaign</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Target</th>
                <th>Status</th>
                <th>Current</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Banners</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->id }}</td>
                <td>{{ $campaign->name }}</td>
                <td>{{ $campaign->description }}</td>
                <td>{{ $campaign->target }}</td>
                <td>{{ $campaign->status }}</td>
                <td>{{ $campaign->current }}</td>
                <td>{{ $campaign->created_at }}</td>
                <td>{{ $campaign->updated_at }}</td>
                <td>
                    @foreach ($campaign->banners as $banner)
                    <p>{{ $banner->url }}</p>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.campaign.edit', $campaign->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.campaign.destroy', $campaign->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection