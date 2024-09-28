<x-app-layout>

<div class="flex flex-wrap md:flex-nowrap mt-5">
        <!-- Filters Section -->
       <x-search.filters :brands="$brands" :category="$category"></x-search.filters>

        <!-- Products Section -->
       <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</div>
</x-app-layout>
