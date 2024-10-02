@props(['productCategories'=>[], 'routeAction'=>'', 'label'=>''])
<aside class="w-full md:w-1/4 mb-8 md:mb-0">
    <div class="p-4 bg-white rounded-lg shadow">
        
        <h2 class="font-semibold text-lg mb-4">{{ $label }}</h2>
            
            <!-- Category Filter -->
            <div class="mb-4 flex flex-col">
                <a href="{{ $routeAction }}" class="font-semibold">{{ $label }}</a>
                @foreach($productCategories as $category)
                    <a href="{{ $routeAction }}?category={{ $category->slug }}" class="hover:underline">{{ $category->name }}</a>
                @endforeach
            </div>
    </div>
</aside>