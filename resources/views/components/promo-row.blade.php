<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Promo Row Container -->
        <div class="relative overflow-hidden" id="promo-carousel">
            <!-- Promo Panels -->
            <div class="flex transition-transform duration-500 ease-in-out" id="promo-panels">
                <!-- Promo Panel 1 -->
                <div class="w-full md:w-1/3 flex-shrink-0 p-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Promo 1</h3>
                        <p class="text-gray-600">This is the description for promo 1. Amazing deals await you!</p>
                        <a href="#" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Learn More</a>
                    </div>
                </div>
                <!-- Promo Panel 2 -->
                <div class="w-full md:w-1/3 flex-shrink-0 p-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Promo 2</h3>
                        <p class="text-gray-600">Don't miss out on promo 2. Limited time offer!</p>
                        <a href="#" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Learn More</a>
                    </div>
                </div>
                <!-- Promo Panel 3 -->
                <div class="w-full md:w-1/3 flex-shrink-0 p-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col items-center justify-center p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Promo 3</h3>
                        <p class="text-gray-600">Get the best deals with promo 3. Shop now!</p>
                        <a href="#" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-3 py-3 rounded-full shadow-md opacity-50 hidden">
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

<!-- JavaScript for Promo Carousel Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('promo-panels');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');

        // Get all promo panels and calculate width
        const items = carousel.children;
        let itemWidth = items[0].offsetWidth; // Width of one panel
        let visibleItems = Math.floor(carousel.parentElement.offsetWidth / itemWidth);
        let index = 0;

        // Update button visibility initially
        updateButtonVisibility();

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
            updateButtonVisibility(); // Check button visibility after moving
        }

        function updateButtonVisibility() {
            // Hide prev button if at the first item
            if (index === 0) {
                prevButton.classList.add('hidden');
                prevButton.disabled = true;
            } else {
                prevButton.classList.remove('hidden');
                prevButton.disabled = false;
            }

            // Hide next button if last item is fully visible
            if (index >= items.length - visibleItems) {
                nextButton.classList.add('hidden');
                nextButton.disabled = true;
            } else {
                nextButton.classList.remove('hidden');
                nextButton.disabled = false;
            }
        }

        // Recalculate the number of visible items and update the carousel on window resize
        window.addEventListener('resize', function() {
            // Recalculate item width and visible items
            itemWidth = items[0].offsetWidth;
            visibleItems = Math.floor(carousel.parentElement.offsetWidth / itemWidth);
            updateCarousel(); // Adjust carousel position based on new visible items
        });
    });
</script>
