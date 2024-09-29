<x-app-layout>

    <div class="flex flex-wrap md:flex-nowrap mt-5">
        <x-search.filters :brands="$brands" :category="$category" routeAction="{{ route('categories.show', $category->slug) }}"></x-search.filters>
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>
