@props(['id', 'details'])
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