@props(['categories'])

<div class="flex flex-wrap justify-center bg-gray-100 w-screen">
    @foreach ($categories as $category)
        <div class="relative group">
            <!-- Button to toggle the dropdown -->
            <button 
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <span>{{ $category->name }}</span>
                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown content -->
            <div class="dropdown-content absolute w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                <div class="py-1">
                    @if ($category->subcategories->isNotEmpty())
                        {{-- Sub categories --}}
                        @foreach ($category->subcategories as $subcategory)
                            <a href="{{ route('categories.subcategories.show', [$category->slug, $subcategory->slug]) }}"
                                class="block px-4 py-2 text-sm font-bold text-gray-700 hover:bg-gray-100">
                                {{ $subcategory->name }}
                            </a>
                            {{-- Sub sub categories --}}
                            @if ($subcategory->subsubcategories->isNotEmpty())
                                @foreach ($subcategory->subsubcategories as $subsubcategory)
                                    <a href="{{ route('categories.subcategories.show', [$category->slug, $subcategory->slug, $subsubcategory->slug]) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $subsubcategory->name }}
                                    </a>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
