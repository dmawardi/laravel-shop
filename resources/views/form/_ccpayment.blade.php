{{-- Credit Card Information --}}
<div>
    <form action="{{ route('payment.submit') }}" method="POST">
        @csrf

        {{-- Card number --}}
        <div class="px-4">
            <x-input-label for="card_number" value="Card Number" />
            <x-text-input name="card_number" placeholder="Card Number" class="w-full p-2 border rounded mb-2"
                :value="old('card_number')" />
            <x-input-error :messages="$errors->get('card_number')" />
        </div>

        {{-- Expiration --}}
        <div class="flex items-end">
            <div class="flex w-1/2 px-2 items-end">
                <div class="w-1/2 px-1">
                    <x-input-label for="exp_month" value="Expiration Month" />
                    <x-text-input name="exp_month" placeholder="MM" class="w-full p-2 border rounded mb-2"
                        :value="old('exp_month')" />
                    <x-input-error :messages="$errors->get('exp_month')" />
                </div>
                <div class="w-1/2 px-1">
                    <x-input-label for="exp_year" value="Expiration Year" />
                    <x-text-input name="exp_year" placeholder="YY" class="w-full p-2 border rounded mb-2"
                        :value="old('exp_year')" />
                    <x-input-error :messages="$errors->get('exp_year')" />
                </div>
            </div>
            <div class="w-1/2 px-4">
                {{-- Security code --}}
                <x-input-label for="cvc" value="CVC" />
                <x-text-input name="cvc" placeholder="CVC" class="w-full p-2 border rounded mb-2"
                    :value="old('card_cvc')" />
                <x-input-error :messages="$errors->get('card_cvc')" />

            </div>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-500 p-4 rounded mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-primary-button>Submit Payment</x-primary-button>
    </form>
</div>
