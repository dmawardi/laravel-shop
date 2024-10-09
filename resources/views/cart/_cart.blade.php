<div>
    <h3 class="font-medium">Your Cart Items</h3>
    @if (session('cart'))
    <ul>
            @php $overallTotal = 0; @endphp
            @foreach (session('cart') as $id => $details)
                <!-- Add total -->
                @php $overallTotal += $details['subtotal']; @endphp

                <li class="mb-4">
                    {{ $details['name'] }} - ${{ number_format($details['price'], 2) }} x
                    {{ $details['quantity'] }}
                    <span class="font-bold">Total:
                        ${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                </li>
            @endforeach
        </ul>
        <div class="mt-4 text-lg font-semibold text-right">
            Total: ${{ number_format($overallTotal, 2) }}
        </div>
        @endif
</div>
