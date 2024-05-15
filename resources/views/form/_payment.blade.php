{{-- Credit Card Information --}}
<div>
    <div>
        <x-input-label for="card_number" value="Card Number" />
        <x-text-input name="card_number" placeholder="Card Number" class="w-full p-2 border rounded mb-2"
            :value="old('card_number')" />
        <x-input-error :messages="$errors->get('card_number')" />

        <x-input-label for="card_expiry" value="Expiration Date" />
        <x-text-input name="card_expiry" placeholder="MM/YY" class="w-full p-2 border rounded mb-2" :value="old('card_expiry')" />
        <x-input-error :messages="$errors->get('card_expiry')" />

        <x-input-label for="card_cvc" value="CVC" />
        <x-text-input name="card_cvc" placeholder="CVC" class="w-full p-2 border rounded mb-2" :value="old('card_cvc')" />
        <x-input-error :messages="$errors->get('card_cvc')" />
    </div>
</div>
