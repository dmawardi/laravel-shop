@props(['categories'])
<div class="flex flex-wrap justify-center bg-white w-screen relative mb-5">
    @foreach ($categories as $category)
        <x-layouts.bottom-nav-button :link="route('categories.show', [$category->slug])" :dataID="$category->id" :label="$category->name" />
       
        <!-- Dropdown content -->
         <x-layouts.dropdown-content :dataID="$category->id">
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
        </x-layouts.dropdown-content>
    @endforeach
</div>
