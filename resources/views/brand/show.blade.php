<x-app-layout title="Explore {{ $brand->name }} Beauty Products | Mona" 
description="Shop the latest {{ $brand->name }} makeup, skincare, and hair care products at Mona. Discover high-quality beauty essentials that fit your routine." 
keywords="{{ $brand->name }} beauty products, {{ $brand->name }} skincare, {{ $brand->name }} hair care, premium beauty, Mona, makeup brands" 
canonical="{{ route('brands.show', $brand->slug) }}">
    <div class="flex flex-wrap md:flex-nowrap mt-5">
        <!-- Filters -->
        <x-search.filters :label="$brand->name" :brands="$brands" routeAction="{{ route('brands.show', $brand->slug) }}"></x-search.filters>
        <!-- Product results -->
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>