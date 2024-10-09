@if (session('cart') && count(session('cart')) > 0)
    <div class="overflow-x-auto mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Item</th>
                    <th scope="col" class="py-3 px-6">Price</th>
                    <th scope="col" class="py-3 px-6">Quantity</th>
                    <th scope="col" class="py-3 px-6 text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $overallTotal = 0; @endphp
                @foreach (session('cart') as $id => $details)
                    @php $overallTotal += $details['subtotal']; @endphp
                    <x-cart.item :id="$id" :details="$details" />
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-lg font-semibold text-right">
        Total: ${{ number_format($overallTotal, 2) }}
    </div>
    <a href="{{ route('cart.checkout') }}"
        class="mt-4 inline-block text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm px-6 py-2.5">Proceed
        to Checkout</a>
@else
    <p class="mt-6 text-gray-700">Your cart is empty.</p>
@endif