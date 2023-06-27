<!-- resources/views/admin/orders/show.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Details</h1>

    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User ID</th>
            <td>{{ $order->user_id }}</td>
        </tr>
        <tr>
            <th>Campaign ID</th>
            <td>{{ $order->campaign_id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $order->address }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $order->phone_number }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $order->price }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $order->quantity }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ $order->total }}</td>
        </tr>
        <tr>
            <th>Payment</th>
            <td>{{ $order->payment_method }}</td>
        </tr>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back to Orders</a>
</div>
@endsection