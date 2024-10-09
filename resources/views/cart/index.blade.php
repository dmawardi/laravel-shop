<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold">Your Shopping Cart</h1>
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6">{{ $details['name'] }}</td>
                                <td class="py-4 px-6">${{ number_format($details['price'], 2) }}</td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                            min="1" class="text-center w-16">
                                        <button type="submit"
                                            class="ml-2 text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-4 py-2">Update</button>
                                    </form>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-row justify-end">
                                        <span class="my-auto">
                                            ${{ number_format($details['subtotal'], 2) }}
                                        </span>
                                        <form action="{{ route('cart.destroy', $id) }}" class="pl-2" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-2 py-1">X</button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
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
    </div>
</x-app-layout>
