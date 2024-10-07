<x-app-layout title="{{ $product->name }} | Buy Online at Mona" 
description="Shop {{ $product->name }} at Mona. Explore this premium beauty product, read reviews, and more." 
canonical="{{ route('products.show', ['product' => $product->slug]) }}">

    <div class="container w-2/3 mx-auto px-4 py-6">
        {{-- Main Product Section --}}
        <div class="flex flex-wrap">
            {{-- Left - Images --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white p-4 shadow-lg rounded-md">
                    <img src="{{ $product->images[0]->src }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-md">
                    <div class="mt-4 flex space-x-2">
                        @foreach ($product->images as $image)
                            <img src="{{ $image }}" alt="Product image" class="w-16 h-16 object-cover rounded-md">
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right - Details --}}
            <div class="w-full lg:w-2/3 pl-8">
                <h2 class="text-2xl font-bold">{{ $product->name }}</h2>
                <p class="text-lg text-gray-600 mt-2">{{ $product->brand->name }}</p>

                {{-- Price, Variant, and Purchase Options --}}
                <div class="flex flex-col mt-4">
                    {{-- Price --}}
                    <span class="text-xl font-semibold">${{ $product->price }}</span>

                    {{-- Form for adding to cart --}}
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- Variant Options (e.g., Size, Color) --}}
                        <div class="mt-4">
                            <label for="variant" class="block text-sm font-medium text-gray-700">Choose a variant:</label>
                            <select id="variant" name="variant_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($product->images as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->name }} ({{ $variant->additional_price ? '+$' . $variant->additional_price : 'No additional cost' }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Shipping Options --}}
                        <div class="mt-4">
                            <label for="shipping" class="block text-sm font-medium text-gray-700">Choose shipping option:</label>
                            <select id="shipping" name="shipping_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="standard">Standard Shipping (Free)</option>
                                <option value="express">Express Shipping (+$5.00)</option>
                                <option value="overnight">Overnight Shipping (+$15.00)</option>
                            </select>
                        </div>

                        
                        {{-- Add to Cart Button --}}
                        <div class="mt-6 flex items-center justify-end space-x-4">
                            {{-- Quantity Selector --}}
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" class="mt-1 block w-20 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0 mx-2 bg-black text-white p-2">
                                Add to Cart
                            </button>
                        </div>
                    </form>
                </div>

               

            </div>
        </div>
        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        {{-- Highlights --}}
        <div class="mt-6">
            <h3 class="font-semibold text-lg">Highlights</h3>
            <div class="flex flex-wrap">
                @foreach ($product->tags as $tag)
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="flex align-middle">
                        <svg width="40px" height="40px" viewBox="0 0 30 30" id="Layer_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <style type="text/css">
                            .st0{fill:#FD6A7E;}
                            .st1{fill:#17B978;}
                            .st2{fill:#8797EE;}
                            .st3{fill:#41A6F9;}
                            .st4{fill:#37E0FF;}
                            .st5{fill:#2FD9B9;}
                            .st6{fill:#F498BD;}
                            .st7{fill:#FFDF1D;}
                            .st8{fill:#C6C9CC;}
                        </style>
                        <path class="st0" d="M25.3,7.5L25.3,7.5c-2.9-2.9-7.4-2.9-10.2,0l0,0l0,0c-2.8-2.8-7.4-2.8-10.2,0c-2.7,2.7-2.9,6.9-0.4,9.8  c1.3,1.5,2.6,2.8,4,4.1c0.6-0.3,1.4-0.6,2.1-1l0,0c0,0,3-1.3,4.9-4.1c-2.4,1.7-4.7,2.4-5.7,2.6c-0.4-1.5-0.1-3.1,1-4.2  c1.5-1.5,5.8-1.9,7.3-4.3c0.2-0.3,0.6-0.3,0.8,0c0.7,1.6,1.9,5.4-0.7,9.3c-1.3,2-4.2,2.9-6.3,1.8c-0.7,0.5-1.4,1-1.9,1.3  c1.6,1.4,3.3,2.7,5.1,3.9c4.1-2.6,7.6-5.8,10.7-9.4C28.1,14.4,27.9,10.2,25.3,7.5z"/>
                        </svg>
                        <span class="font-semibold my-auto">{{ $tag->name }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        {{-- Product Info --}}
        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        <div class="mt-6">
            <h3 class="text-xl font-semibold">About the Product</h3>
            <p class="text-gray-700">{{ $product->description }}</p>
        </div>

        {{-- Ingredients Section --}}
        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        <div class="mt-8">
            <div class="flex cursor-pointer" id="ingredients-toggle">
                <h3 class="text-xl font-semibold">Ingredients</h3>
                <span id="ingredients-arrow" class="transform transition-transform duration-300 ml-3">&#9660;</span> <!-- Down Arrow -->
            </div>
            <div id="ingredients-content" class="mt-2 hidden">
                <p class="text-gray-700">{{ $product->ingredients }}</p>
            </div>
        </div>

        {{-- How to Use Section --}}
        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        <div class="mt-8">
            <div class="flex cursor-pointer" id="how-to-use-toggle">
                <h3 class="text-xl font-semibold">How to Use</h3>
                <span id="how-to-use-arrow" class="transform transition-transform duration-300 ml-3">&#9660;</span> <!-- Down Arrow -->
            </div>
            <div id="how-to-use-content" class="mt-2 hidden">
                <p class="text-gray-700">{{ $product->directions }}</p>
            </div>
        </div>

        {{-- Reviews Section --}}
        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
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
        </div>
    </div>
</x-app-layout>
