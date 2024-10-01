@props(['categories'])
<div class="flex flex-wrap justify-center bg-white w-screen relative mb-5">

    <x-layouts.bottom-nav-button :link="route('brands.index')" :dataID="0" :label="__('Brands')" />
    <x-layouts.dropdown-content :dataID="0">
        <div class="flex flex-row flex-wrap mx-auto w-2/3">
            <div class="basis-1/3">
                <x-layouts.title-link label="Brands A to Z" link="{{ route('brands.index') }}" />
            </div>
            <div class="basis-1/3">
                    <p class="block px-4 py-2 text-sm font-extrabold text-gray-700">
                        Top Brands
                    </p>
                    @foreach($brands as $brand)
                        <x-layouts.sub-link :link="route('brands.show', [$brand->slug])" :label="$brand->name" />
                    @endforeach
                </div>
        </div>
    </x-layouts.dropdown-content>
    <!-- Categories -->
    @foreach ($categories as $category)
        <x-layouts.bottom-nav-button :link="route('categories.show', [$category->slug])" :dataID="$category->id" :label="$category->name" />
        <!-- Dropdown content -->
         <x-layouts.dropdown-content :dataID="$category->id">
            <div class="flex flex-row flex-wrap mx-auto w-2/3">
                @foreach($category->children as $subcategory)
                    <div class="basis-1/3">
                        <x-layouts.title-link :label="$subcategory->name" :link="route('categories.show', [$subcategory->slug])" />
                      
                        @foreach($subcategory->children as $subsubcategory)
                             <x-layouts.sub-link :link="route('categories.show', [$subsubcategory->slug])" :label="$subsubcategory->name" />
                        @endforeach

                    </div>
                @endforeach
            </div>
        </x-layouts.dropdown-content>
    @endforeach
</div>
