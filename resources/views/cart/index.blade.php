<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold">Your Shopping Cart</h1>
        @include('cart._cart')
        <a href="{{ route('cart.checkout') }}"
        class="mt-4 inline-block text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm px-6 py-2.5">Proceed
        to Checkout</a>
    </div>
</x-app-layout>
