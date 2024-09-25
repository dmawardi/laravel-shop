// Main Carousel
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("main-carousel");
    const prevButton = document.getElementById("main-carousel-prev");
    const nextButton = document.getElementById("main-carousel-next");
    const items = carousel.children;
    let itemWidth = items[0].offsetWidth;
    let visibleItems = Math.floor(
        carousel.parentElement.offsetWidth / itemWidth
    );
    let index = 0;

    // Update button visibility initially
    updateButtonVisibility();

    prevButton.addEventListener("click", function () {
        if (index > 0) {
            index--;
            updateCarousel();
        }
    });

    nextButton.addEventListener("click", function () {
        if (index < items.length - visibleItems) {
            index++;
            updateCarousel();
        }
    });

    function updateCarousel() {
        console.log("Updating carousel");
        carousel.style.transform = `translateX(-${index * itemWidth}px)`;
        updateButtonVisibility();
    }

    function updateButtonVisibility() {
        // Hide prev button if at the first item
        if (index === 0) {
            prevButton.classList.add("hidden");
            prevButton.disabled = true;
        } else {
            prevButton.classList.remove("hidden");
            prevButton.disabled = false;
        }

        // Hide next button if last item is fully visible
        if (index >= items.length - visibleItems) {
            nextButton.classList.add("hidden");
            nextButton.disabled = true;
        } else {
            nextButton.classList.remove("hidden");
            nextButton.disabled = false;
        }
    }

    // Recalculate the number of visible items and update the carousel on window resize
    window.addEventListener("resize", function () {
        // Recalculate item width and visible items
        itemWidth = items[0].offsetWidth;
        visibleItems = Math.floor(
            carousel.parentElement.offsetWidth / itemWidth
        );
        updateCarousel();
    });
});

// Product Collection Row Carousel
document.addEventListener("DOMContentLoaded", function () {
    // Select all carousels on the page
    const carousels = document.querySelectorAll(".product-carousel");

    carousels.forEach((carousel) => {
        const carouselId = carousel.getAttribute("data-carousel-id");
        const prevButton = document.querySelector(
            `.prev[data-carousel-id="${carouselId}"]`
        );
        const nextButton = document.querySelector(
            `.next[data-carousel-id="${carouselId}"]`
        );
        const items = carousel.children;
        let itemWidth = items[0].offsetWidth + 16; // Width of one item including margin
        let visibleItems = Math.floor(
            carousel.parentElement.offsetWidth / itemWidth
        );
        let index = 0;

        // Update button visibility initially
        updateButtonVisibility();

        prevButton.addEventListener("click", function () {
            if (index > 0) {
                index--;
                updateCarousel();
            }
        });

        nextButton.addEventListener("click", function () {
            if (index < items.length - visibleItems - 1) {
                // Allow one item before the last one
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
                prevButton.classList.add("hidden");
                prevButton.disabled = true;
            } else {
                prevButton.classList.remove("hidden");
                prevButton.disabled = false;
            }

            // Hide next button if second-to-last set of items is visible
            if (index >= items.length - visibleItems - 1) {
                // Updated condition to disable one card earlier
                nextButton.classList.add("hidden");
                nextButton.disabled = true;
            } else {
                nextButton.classList.remove("hidden");
                nextButton.disabled = false;
            }
        }

        // Recalculate the number of visible items and update the carousel on window resize
        window.addEventListener("resize", function () {
            // Recalculate item width and visible items
            itemWidth = items[0].offsetWidth + 16;
            visibleItems = Math.floor(
                carousel.parentElement.offsetWidth / itemWidth
            );
            updateCarousel(); // Adjust carousel position based on new visible items
        });
    });
});

// Promo row carousel
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("promo-panels");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");

    // Get all promo panels and calculate width
    const items = carousel.children;
    let itemWidth = items[0].offsetWidth; // Width of one panel
    let visibleItems = Math.floor(
        carousel.parentElement.offsetWidth / itemWidth
    );
    let index = 0;

    // Update button visibility initially
    updateButtonVisibility();

    prevButton.addEventListener("click", function () {
        if (index > 0) {
            index--;
            updateCarousel();
        }
    });

    nextButton.addEventListener("click", function () {
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
            prevButton.classList.add("hidden");
            prevButton.disabled = true;
        } else {
            prevButton.classList.remove("hidden");
            prevButton.disabled = false;
        }

        // Hide next button if last item is fully visible
        if (index >= items.length - visibleItems) {
            nextButton.classList.add("hidden");
            nextButton.disabled = true;
        } else {
            nextButton.classList.remove("hidden");
            nextButton.disabled = false;
        }
    }

    // Recalculate the number of visible items and update the carousel on window resize
    window.addEventListener("resize", function () {
        // Recalculate item width and visible items
        itemWidth = items[0].offsetWidth;
        visibleItems = Math.floor(
            carousel.parentElement.offsetWidth / itemWidth
        );
        updateCarousel(); // Adjust carousel position based on new visible items
    });
});
