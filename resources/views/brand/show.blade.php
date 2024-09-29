<x-app-layout>
    <div class="flex flex-wrap md:flex-nowrap mt-5">
        <!-- Filters -->
        <x-search.filters :brands="$brands" routeAction="{{ route('brand.show', $brand->slug) }}"></x-search.filters>
        <!-- Product results -->
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>