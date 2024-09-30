@props(['categories'])
<div class="flex flex-wrap justify-center bg-white w-screen relative mb-5">
    @foreach ($categories as $category)
        <x-layouts.bottom-nav-button :link="route('categories.show', [$category->slug])" :dataID="$category->id" :label="$category->name" />
       
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
