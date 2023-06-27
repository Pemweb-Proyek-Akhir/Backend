<!-- resources/views/admin/orders/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>

    <!-- Form for creating a new order -->
    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Select User</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="campaign_id">Campaign</label>
            <select name="campaign_id" id="campaign_id" class="form-control">
                <option value="">Select Campaign</option>
                @foreach ($campaigns as $campaign)
                <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="package_id">Package</label>
            <select name="package_id" id="package_id" class="form-control">
                <option value="">Select Package</option>
                @foreach ($packages as $package)
                <option value="{{ $package->id }}" data-price="{{ $package->price }}">{{ $package->name }} - {{ $package->price }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" required readonly>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <script>
            // Mengambil referensi elemen input price, quantity, dan total
            const priceInput = document.getElementById('price');
            const quantityInput = document.getElementById('quantity');
            const totalInput = document.getElementById('total');
            const packageSelect = document.getElementById('package_id');

            // Event listener untuk menghitung total saat ada perubahan pada price atau quantity
            priceInput.addEventListener('input', calculateTotal);
            quantityInput.addEventListener('input', calculateTotal);
            packageSelect.addEventListener('change', updatePrice);

            // Fungsi untuk menghitung total
            function calculateTotal() {
                const price = parseFloat(priceInput.value) || 0;
                const quantity = parseFloat(quantityInput.value) || 0;
                const total = price * quantity;

                // Mengupdate nilai totalInput dengan hasil perhitungan
                totalInput.value = total.toFixed(2);
            }

            // Fungsi untuk mengupdate harga (price) saat memilih paket
            function updatePrice() {
                const selectedPackage = packageSelect.options[packageSelect.selectedIndex];
                const price = selectedPackage.getAttribute('data-price');
                priceInput.value = price;
                calculateTotal();
            }
        </script>

        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="">Select payment_method</option>
                <option value="ShopeePay">ShopeePay</option>
                <option value="GoPay">GoPay</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection