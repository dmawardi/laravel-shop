{{-- Shipping Options --}}
<div class="mt-4">
    <label for="shipping" class="block text-sm font-medium text-gray-700">Choose shipping option:</label>
    <select id="shipping" name="shipping_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @foreach($shippingMethods as $method)
            <option value="{{ $method->id }}">{{ $method->name }} (+${{ $method->base_price }})</option>
        @endforeach
    </select>
</div>