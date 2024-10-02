<x-app-layout>
    <div class="mt-5 w-2/3 mx-auto">
        <h1 class="text-2xl font-bold">Brands A-Z</h1>

        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        <h2 class="font-bold text-xl">
            All Brands
        </h2>

        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>
        @php
        $alphabets = range('A', 'Z');
        @endphp
        <div>
            @foreach ($alphabets as $alphabet)
                <a href="#brand-{{$alphabet}}" class="font-bold text-lg md:text-xl mx-2">{{$alphabet}}</a>
            @endforeach
        </div>

        <!-- Separator -->
        <div class="my-4 border-b-2 border-gray-300"></div>


        @foreach ($alphabets as $alphabet)
            <div class="py-2">
                <!-- Alphabet Heading -->
                <h2 id="brand-{{ $alphabet }}" class="text-xl font-semibold">{{ $alphabet }}</h2>

                <!-- Check if there are any brands under the current alphabet -->
                @if (isset($groupedBrands[$alphabet]))
                    <!-- Apply CSS columns for vertical layout -->
                    <div class="columns-1 sm:columns-2 lg:columns-4">
                        <ul class="list-none">
                            @foreach ($groupedBrands[$alphabet] as $brand)
                                <li>
                                    <a href="{{ route('brands.show', $brand->slug) }}" class="hover:underline">
                                        {{ $brand->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p>No brands starting with {{ $alphabet }}.</p>
                @endif
                <!-- Separator -->
                <div class="mb-3 mt-8 border-b-2 border-gray-300"></div>
            </div>
        @endforeach
        
    </div>
</x-app-layout>