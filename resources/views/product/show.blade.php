<x-app-layout title=" {{ $product->name }} | {{ $product->brand->name }} | Buy Online at Mona" 
description="Shop {{ $product->name }} from {{ $product->brand->name }} at Mona. Explore this premium {{ $product->category->name }} product, read reviews, and add it to your beauty routine today." 
keywords="{{ $product->name }}, {{ $product->brand->name }} {{ $product->category->name }}, buy {{ $product->name }} online, premium beauty products, Mona, {{ $product->brand->name }} beauty, beauty store" 
canonical="{{ route('products.show', $product->slug) }}">
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-md">
            <h2 class="text-lg font-semibold mt-4">{{ $product->name }}</h2>
            <p class="text-gray-600 mt-2">{{ $product->description }}</p>
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-800 font-semibold">${{ $product->price }}</span>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to
                        Cart</button>
                </form>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Reviews</h3>
                @foreach ($product->reviews as $review)
                    <div class="mt-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="font-semibold">{{ $review->user->name }}</span>
                                <span class="text-gray-600 text-sm">- {{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <span
                                class="text-yellow-500">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        </div>
                        <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
            @auth
                <div class="mt-6">
                    <h3 class="text-lg font-semibold">Leave a Review</h3>
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
