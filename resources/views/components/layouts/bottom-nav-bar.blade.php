@props(['categories'])
<div class="flex flex-wrap justify-center bg-white w-screen relative mb-5">
    @foreach ($categories as $category)
        <div class="relative group">
            <!-- Button to toggle the dropdown -->
             <a href="{{ route('categories.show', [$category->slug]) }}">
                 <button 
                 data-category-id="{{ $category->id }}"
                 class="bottom-nav-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-extrabold rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                 <span>{{ $category->name }}</span>
                </button>
            </a>
            
        </div>
        <!-- Dropdown content -->
        <!-- Sub categories -->
        <div class="dropdown-content absolute w-screen top-full left-0 right-0 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 hidden z-50"
                data-category-id="{{ $category->id }}"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <div class="flex flex-row flex-wrap mx-auto w-2/3">
                    @foreach($category->children as $subcategory)
                        <div class="basis-1/3">
                            <a href="{{ route('categories.show', [$subcategory->slug]) }}"
                                class="block px-4 py-2 text-sm font-extrabold text-gray-700 hover:bg-gray-100">
                                {{ $subcategory->name }}
                            </a>
                            @foreach($subcategory->children as $subsubcategory)
                                <a href="{{ route('categories.show', [$subsubcategory->slug]) }}"
                                    class="block px-4 my-0 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $subsubcategory->name }}
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all buttons and dropdowns
        const categoryButtons = document.querySelectorAll('.bottom-nav-button');
        const dropdowns = document.querySelectorAll('.dropdown-content');

        categoryButtons.forEach(button => {
            const categoryId = button.getAttribute('data-category-id');
            // Get the dropdown for the current category
            const dropdown = document.querySelector(`.dropdown-content[data-category-id="${categoryId}"]`);

            // Show dropdown on hover over the button
            button.addEventListener('mouseenter', () => {
                hideAllDropdowns(); // Hide any open dropdowns
                dropdown.classList.remove('hidden');
            });

            // Hide dropdown on mouse leave from the button
            button.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!dropdown.matches(':hover')) {
                        dropdown.classList.add('hidden');
                    }
                }, 100); // Delay to allow moving to dropdown
            });

            // Keep dropdown visible when hovering over it
            dropdown.addEventListener('mouseenter', () => {
                dropdown.classList.remove('hidden');
            });

            // Hide dropdown when mouse leaves the dropdown area
            dropdown.addEventListener('mouseleave', () => {
                dropdown.classList.add('hidden');
            });
        });

        // Function to hide all dropdowns
        function hideAllDropdowns() {
            dropdowns.forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
</script>

