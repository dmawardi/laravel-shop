<div>
    <h3 class="font-medium">Payment Method</h3>
    {{-- Payment Method Selection --}}
    <x-input-label for="payment_method" value="Choose Payment Method" />
    <select name="payment_method" id="payment_method" class="w-full p-2 border rounded mb-2" required>
        <option value="">Select a Payment Method</option>
        <option value="Credit Card" @if (old('payment_method') == 'Credit Card') selected @endif>Credit Card</option>
        <option value="PayPal" @if (old('payment_method') == 'PayPal') selected @endif>PayPal</option>
        <option value="Bank Transfer" @if (old('payment_method') == 'Bank Transfer') selected @endif>Bank Transfer</option>
    </select>
    <x-input-error :messages="$errors->get('payment_method')" />
</div>
