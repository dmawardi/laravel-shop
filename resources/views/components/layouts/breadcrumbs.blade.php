@props(['category', 'ancestors'])
<div class="container mx-auto px-4">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-4" aria-label="Breadcrumb">
        <ol class="list-reset flex text-gray-500">
            <li>
                <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Home</a>
            </li>
            @if($category->parent)
                <!-- Loop through parent categories for full breadcrumb -->
                @foreach($ancestors as $ancestor)
                    <li>
                        <span class="mx-2">/</span>
                        <a href="{{ route('categories.show', $ancestor->slug) }}" class="text-blue-500 hover:underline">
                            {{ $ancestor->name }}
                        </a>
                    </li>
                @endforeach
            @endif
            <li>
                <span class="mx-2">/</span>
                <span>{{ $category->name }}</span>
            </li>
        </ol>
    </nav>
</div>