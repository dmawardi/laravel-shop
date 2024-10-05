<x-app-layout title="Shop Premium Beauty Products | Makeup, Skincare & Hair Care | Mona" 
description="Discover a wide range of makeup, skincare, and hair care products at Mona. Shop the latest beauty trends and find products tailored to your needs." 
keywords="beauty products, makeup, skincare, hair care, premium beauty, Mona, beauty store, buy beauty products online" 
canonical="{{ route('products.index') }}">
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-lg font-semibold">Products</h2>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="border p-4">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img src="{{ $product->images[0]->src }}" alt="{{ $product->name }}" class="w-full h-32 object-cover mb-2">
                        <h3 class="text-md font-semibold">{{ $product->name }}</h3>
                    </a>
                    <p>${{ $product->price }}</p>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->images[0]->src }}">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mt-2">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
