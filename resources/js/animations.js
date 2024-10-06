// Navigation dropdown
document.addEventListener("DOMContentLoaded", function () {
    // Get all buttons and dropdowns
    const categoryButtons = document.querySelectorAll(".bottom-nav-button");
    const dropdowns = document.querySelectorAll(".dropdown-content");

    categoryButtons.forEach((button) => {
        const dataID = button.getAttribute("data-nav-id");
        // Get the dropdown for the current category
        const dropdown = document.querySelector(
            `.dropdown-content[data-nav-id="${dataID}"]`
        );

        // Show dropdown on hover over the button
        button.addEventListener("mouseenter", () => {
            hideAllDropdowns(); // Hide any open dropdowns
            dropdown.classList.remove("hidden");
        });

        // Hide dropdown on mouse leave from the button
        button.addEventListener("mouseleave", () => {
            setTimeout(() => {
                if (!dropdown.matches(":hover")) {
                    dropdown.classList.add("hidden");
                }
            }, 100); // Delay to allow moving to dropdown
        });

        // Keep dropdown visible when hovering over it
        dropdown.addEventListener("mouseenter", () => {
            dropdown.classList.remove("hidden");
        });

        // Hide dropdown when mouse leaves the dropdown area
        dropdown.addEventListener("mouseleave", () => {
            dropdown.classList.add("hidden");
        });
    });

    // Function to hide all dropdowns
    function hideAllDropdowns() {
        dropdowns.forEach((dropdown) => {
            dropdown.classList.add("hidden");
        });
    }
});

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
        let itemWidth = items[0].offsetWidth; // Width of one item including margin
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
            if (index >= items.length - visibleItems) {
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
            itemWidth = items[0].offsetWidth;
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

// Product information dropdowns
document.addEventListener("DOMContentLoaded", function () {
    // Toggle for Ingredients Section
    const ingredientsToggle = document.getElementById("ingredients-toggle");
    const ingredientsContent = document.getElementById("ingredients-content");
    const ingredientsArrow = document.getElementById("ingredients-arrow");

    ingredientsToggle.addEventListener("click", function () {
        ingredientsContent.classList.toggle("hidden");
        ingredientsArrow.classList.toggle("rotate-180"); // Rotate arrow for animation
    });

    // Toggle for How to Use Section
    const howToUseToggle = document.getElementById("how-to-use-toggle");
    const howToUseContent = document.getElementById("how-to-use-content");
    const howToUseArrow = document.getElementById("how-to-use-arrow");

    howToUseToggle.addEventListener("click", function () {
        howToUseContent.classList.toggle("hidden");
        howToUseArrow.classList.toggle("rotate-180"); // Rotate arrow for animation
    });
});
