<x-app-layout title="Track Your Orders | Mona" 
description="Keep track of your beauty purchases at Mona. View your order history, shipping status, and manage your account easily." 
keywords="my orders, track orders, Mona account, order history, beauty purchases, makeup orders, skincare orders, Mona" 
canonical="{{ route('order.index') }}">

    <div class="container">
        <h1>My Orders</h1>

        @if ($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
