<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-lg font-semibold">Checkout</h2>
        @if (session('cart') && count(session('cart')) > 0)
            <form action="{{ route('order.store') }}" method="POST" class="flex">
                @csrf
                <div class="basis-1/2 px-4">
                    @include('cart._cart')
                </div>
                <div class="basis-1/2">

                    @include('form._shipping')
                    @include('form._payment-method')


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
                    {{-- Submit button --}}
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Place Order</button>
                </div>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
