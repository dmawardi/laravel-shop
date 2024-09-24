<!-- Carousel Container -->
<div class="relative w-2/3 overflow-hidden mx-auto group">
    <!-- Slides -->
    <div id="carousel" class="flex transition-transform duration-500">
        <!-- Loop to create 3 slides -->
         @for($i = 1; $i <= 3; $i++)
        <div class="w-full flex-shrink-0">
            <a href="/promotion-{{ $i }}">
                <img src="https://via.placeholder.com/800x400?text=Promotion+{{ $i }}" alt="Promotion {{ $i }}" class="w-full h-auto object-cover">
            </a>
        </div>
        @endfor
    </div>

    <!-- Navigation Buttons -->
    <button id="carousel-prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 mx-4 rounded-full text-4xl opacity-0 group-hover:opacity-50 transition-opacity duration-400">
        <
    </button>
    <button id="carousel-next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 mx-4 rounded-full text-4xl opacity-0 group-hover:opacity-50 transition-opacity duration-400">
        >
    </button>
</div>

<!-- JavaScript for Carousel Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('carousel');
        const slides = carousel.children;
        const totalSlides = slides.length;
        let index = 0;

        document.getElementById('carousel-next').addEventListener('click', function() {
            if (index < totalSlides - 1) {
                index++;
                updateCarousel();
            } else {
                index = 0;
                updateCarousel();
            }
        });

        document.getElementById('carousel-prev').addEventListener('click', function() {
            if (index > 0) {
                index--;
                updateCarousel();
            } else {
                index = totalSlides - 1;
                updateCarousel();
            }
        });

        function updateCarousel() {
            carousel.style.transform = `translateX(-${index * 100}%)`;
        }
    });
</script>
