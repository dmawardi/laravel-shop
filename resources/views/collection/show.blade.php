<x-app-layout>
    <div class="flex flex-wrap md:flex-nowrap">
        <x-search.collection-filters :label="$collection->name" :productCategories="$productCategories" routeAction="{{ route('collections.show', $collection) }}"></x-search.collection-filters>
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>
