<x-app-layout>
    <x-layouts.breadcrumbs :category="$category"></x-layouts.breadcrumbs>
    <div class="flex flex-wrap md:flex-nowrap">
        <x-search.filters :brands="$brands" routeAction="{{ route('categories.show', $category->slug) }}"></x-search.filters>
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>
