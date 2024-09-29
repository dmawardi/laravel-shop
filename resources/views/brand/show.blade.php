<x-app-layout>
    <!-- Filters -->
    <x-search.filters :brands="$brands" :category="$category" routeAction="{{ route('brand.show', $brand->slug) }}"></x-search.filters>
    <!-- Product results -->
    <x-search.product-results :products="$products"></x-search.product-results>
</x-app-layout>