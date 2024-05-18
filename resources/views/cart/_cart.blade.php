<div>
    <h3 class="font-medium">Your Cart Items</h3>
    <ul>
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <li class="mb-4">
                    {{ $details['name'] }} - ${{ number_format($details['price'], 2) }} x
                    {{ $details['quantity'] }}
                    <span class="font-bold">Total:
                        ${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
</div>
