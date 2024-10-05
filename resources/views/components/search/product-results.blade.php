<div class="w-full md:w-3/4 md:ml-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <a href="{{ route('products.show', $product->slug) }}">
                    <img src="{{ $product->images[0]->src }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>