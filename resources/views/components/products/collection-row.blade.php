@props(['title' => '', 'subtitle'=>'', 'products' => []])
<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4 group">
        <!-- Section Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $title }}</h2>
        <span>{{$subtitle}}</span>
        
        <!-- Carousel Container -->
        <div class="relative" id="carousel-{{ Str::slug($title) }}">
            <!-- Product Row -->
            <div class="product-carousel flex transition-transform duration-200 ease-in-out" data-carousel-id="{{ Str::slug($title) }}">
                <!-- Product Card -->
                @foreach($products as $product)
                    <div class="w-full sm:w-1/2 lg:w-1/5 flex-shrink-0 p-2">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col">
                            <a href="{{ route('products.show', [$product->slug]) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mt-2">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <button class="prev absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md hidden opacity-0 group-hover:opacity-50 transition-opacity duration-400" data-carousel-id="{{ Str::slug($title) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="next absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md opacity-0 group-hover:opacity-50 transition-opacity duration-400" data-carousel-id="{{ Str::slug($title) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
