<x-app-layout title="Shop {{ $category->name }} Products | Mona" 
description="Explore the best in {{ $category }} at Mona. From foundations to lipsticks, find top-rated products that suit every skin tone and style." 
keywords="{{ $category->name }}, makeup, makeup products, beauty, premium cosmetics, makeup shopping, Mona, beauty store" canonical="{{ route('categories.show', $category->slug) }}">
    <x-layouts.breadcrumbs :category="$category" :ancestors="$ancestors"></x-layouts.breadcrumbs>
    <div class="flex flex-wrap md:flex-nowrap">
        <x-search.filters :label="$category->name" :brands="$brands" routeAction="{{ route('categories.show', $category->slug) }}"></x-search.filters>
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>
