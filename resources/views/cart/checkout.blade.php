<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-lg font-semibold">Checkout</h2>
        @if (session('cart'))
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium">Your Cart Items</h3>
                        <ul>
                            @foreach (session('cart') as $id => $details)
                                <li class="mb-4">
                                    {{ $details['name'] }} - ${{ $details['price'] }} x {{ $details['quantity'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-medium">Shipping Details</h3>
                        <input type="text" name="address" placeholder="Address" class="w-full p-2 border rounded mb-2"
                            required>
                        <input type="text" name="city" placeholder="City" class="w-full p-2 border rounded mb-2"
                            required>
                        <input type="text" name="state" placeholder="State" class="w-full p-2 border rounded mb-2"
                            required>
                        <input type="text" name="zipcode" placeholder="Zip Code"
                            class="w-full p-2 border rounded mb-2" required>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Place
                            Order</button>
                    </div>
                </div>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
