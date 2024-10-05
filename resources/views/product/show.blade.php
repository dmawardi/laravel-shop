<x-app-layout title="{{ $product->name }} | Buy Online at Mona" 
description="Shop {{ $product->name }} at Mona. Explore this premium beauty product, read reviews, and more." 
canonical="{{ route('products.show', ['product' => $product->slug]) }}">

    <div class="container mx-auto px-4 py-6">
        {{-- Main Product Section --}}
        <div class="flex flex-wrap">
            {{-- Left - Images --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white p-4 shadow-lg rounded-md">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-md">
                    <div class="mt-4 flex space-x-2">
                        @foreach ($product->additionalImages as $image)
                            <img src="{{ $image }}" alt="Product image" class="w-16 h-16 object-cover rounded-md">
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right - Details --}}
            <div class="w-full lg:w-2/3 pl-8">
                <h2 class="text-2xl font-bold">{{ $product->name }}</h2>
                <p class="text-lg text-gray-600 mt-2">{{ $product->brand->name }}</p>

                {{-- Price and Purchase Options --}}
                <div class="flex items-center mt-4">
                    <span class="text-xl font-semibold">${{ $product->price }}</span>
                    <form action="{{ route('cart.store') }}" method="POST" class="ml-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Add to Cart
                        </button>
                    </form>
                </div>

                {{-- Product Info --}}
                <div class="mt-6">
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>

                {{-- Highlights --}}
                <div class="mt-6">
                    <h3 class="font-semibold text-lg">Highlights</h3>
                    <ul class="mt-2 space-y-2">
                        <li><span class="font-semibold">Cruelty-Free</span></li>
                        <li><span class="font-semibold">Vegan</span></li>
                        <li><span class="font-semibold">Best for Normal Skin</span></li>
                        <li><span class="font-semibold">Anti-Aging</span></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Ingredients Section --}}
        <div class="mt-8">
            <h3 class="text-xl font-semibold">Ingredients</h3>
            <div class="bg-white p-4 shadow-md rounded-md mt-4">
                <p class="text-gray-700">{{ $product->ingredients }}</p>
            </div>
        </div>

        {{-- How to Use Section --}}
        <div class="mt-8">
            <h3 class="text-xl font-semibold">How to Use</h3>
            <div class="bg-white p-4 shadow-md rounded-md mt-4">
                <p class="text-gray-700">{{ $product->how_to_use }}</p>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="mt-8">
            <h3 class="text-xl font-semibold">Customer Reviews</h3>
            @foreach ($product->reviews as $review)
                <div class="mt-4 bg-white p-4 shadow-md rounded-md">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold">{{ $review->user->name }}</span>
                            <span class="text-gray-600 text-sm">- {{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <span class="text-yellow-500">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                    </div>
                    <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                </div>
            @endforeach

            @auth
                <div class="mt-6">
                    <h3 class="font-semibold text-lg">Leave a Review</h3>
                    <form action="{{ route('review.store', $product->slug) }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div>
                            <x-input-label for="rating" value="Rating" />
                            <select name="rating" id="rating" class="block mt-1 w-full">
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="comment" value="Comment" />
                            <textarea name="comment" id="comment" rows="4" class="block mt-1 w-full"></textarea>
                        </div>
                        <div class="mt-4">
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
