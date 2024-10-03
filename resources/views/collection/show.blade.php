<x-app-layout title="Discover the {{ $collection->name }} Collection | Mona" 
description="Explore the {{ $collection->name}} collection at Mona. This curated selection includes premium makeup, skincare, and beauty products tailored to meet your needs." 
keywords="{{ $collection->name }} collection, curated beauty collection, premium beauty products, makeup collections, skincare sets, Mona, beauty store" 
canonical="{{ route('collections.show', $collection) }}">
    <div class="flex flex-wrap md:flex-nowrap">
        <x-search.collection-filters :label="$collection->name" :productCategories="$productCategories" routeAction="{{ route('collections.show', $collection) }}"></x-search.collection-filters>
        <x-search.product-results :products="$products"></x-search.product-results>
    </div>
</x-app-layout>
