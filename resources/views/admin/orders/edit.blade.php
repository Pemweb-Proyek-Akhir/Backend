<!-- resources/views/admin/orders/edit.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order</h1>

    <!-- Form for editing an existing order -->
    <form action="{{ route('admin.orders.update', ['id' => $order->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" name="user_id" class="form-control" value="{{ $order->user_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="campaign_id">Campaign ID</label>
            <input type="text" name="campaign_id" class="form-control" value="{{ $order->campaign_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="campaign_id">Package ID</label>
            <input type="text" name="campaign_id" class="form-control" value="{{ $order->package_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $order->name }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $order->address }}">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $order->phone_number }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $order->price }}" readonly>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" class="form-control" value="{{ $order->quantity }}" readonly>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" name="total" class="form-control" value="{{ $order->total }}" readonly>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <input type="text" name="payment_method" class="form-control" value="{{ $order->payment_method }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection