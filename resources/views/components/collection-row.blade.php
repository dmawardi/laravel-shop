<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Section Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Featured Products</h2>
        
        <!-- Carousel Container -->
        <div class="relative">
            <!-- Product Row -->
            <div id="product-carousel" class="flex transition-transform duration-500 ease-in-out">
                <!-- Product Card 1 -->
                @foreach($products as $product)
                    <div class="w-1/3 md:w-1/4 lg:w-1/5 flex-shrink-0 p-2">
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
            <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- JavaScript for Product Carousel Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('product-carousel');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const items = carousel.children;
        const itemWidth = items[0].offsetWidth + 16; // Width of one item including margin
        const visibleItems = Math.floor(carousel.parentElement.offsetWidth / itemWidth);
        let index = 0;

        prevButton.addEventListener('click', function() {
            if (index > 0) {
                index--;
                updateCarousel();
            }
        });

        nextButton.addEventListener('click', function() {
            if (index < items.length - visibleItems) {
                index++;
                updateCarousel();
            }
        });

        function updateCarousel() {
            carousel.style.transform = `translateX(-${index * itemWidth}px)`;
        }

        // Update carousel on window resize
        window.addEventListener('resize', function() {
            updateCarousel();
        });
    });
</script>
