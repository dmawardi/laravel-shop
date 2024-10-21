<div>
    @if (session('cart') && count(session('cart')) > 0)
    <div class="overflow-x-auto mt-6">
        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <div class="text-xs text-gray-700 uppercase bg-gray-50 flex justify-between border-black border-solid">
                <div class="py-4 px-6">
                    <input type="checkbox" id="select-all" class="form-checkbox h-5 w-5 text-blue-600"> 
                    <span class="mx-2">
                        Select All
                    </span>
                </div>
                <div class="flex align-middle m-4">
                    <a href="#">
                        Delete
                    </a>
                </div>
            </div>
            <div>
                @php $overallTotal = 0; @endphp
                @foreach (session('cart') as $id => $details)
                    @php $overallTotal += $details['subtotal']; @endphp
                        <x-cart.item :id="$id" :details="$details" />
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-4 text-lg font-semibold text-right">
        Total: ${{ number_format($overallTotal, 2) }}
    </div>
    @else
    <p class="mt-6 text-gray-700">Your cart is empty.</p>
    @endif
</div>