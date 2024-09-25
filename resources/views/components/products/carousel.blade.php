<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4 group">
        <!-- Carousel Container -->
        <div class="relative overflow-hidden">
            <!-- Slides -->
            <div id="main-carousel" class="flex transition-transform duration-500 ease-in-out">
                <!-- Loop to create 3 slides -->
                @for($i = 1; $i <= 3; $i++)
                    <div class="w-full sm:w-1/2 flex-shrink-0 p-4">
                        <a href="/promotion-{{ $i }}" class="block rounded-sm overflow-hidden shadow-md">
                            <img src="https://via.placeholder.com/600x400?text=Promotion+{{ $i }}" alt="Promotion {{ $i }}" class="w-full h-auto object-cover">
                        </a>
                    </div>
                @endfor
            </div>

            <!-- Navigation Buttons -->
            <button id="main-carousel-prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="main-carousel-next" 
            class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
