<!-- resources/views/admin/orders/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Orders</h1>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Create Order</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Campaign ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->campaign_id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection