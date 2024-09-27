<x-app-layout>

<div class="flex flex-wrap md:flex-nowrap mt-5">
        <!-- Filters Section -->
        <aside class="w-full md:w-1/4 mb-8 md:mb-0">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="font-semibold text-lg mb-4">Filters</h2>
                <!-- Example Filters -->
                <form action="{{ route('categories.show', $category->slug) }}" method="GET">
                    <!-- Price Filter -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Price</h3>
                        <input type="text" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full mb-2 p-2 border rounded">
                        <input type="text" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full p-2 border rounded">
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Brand</h3>
                        
                    </div>

                    <!-- Apply Filters Button -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>

        <!-- Products Section -->
        <div class="w-full md:w-3/4 md:ml-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
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
    </div>
</div>
</x-app-layout>
