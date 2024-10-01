<x-app-layout>
    <div class="mt-5 w-2/3 mx-auto">
        <h1>Brands A-Z</h1>

        <h2>
            All Brands
        </h2>

        @php
        $alphabets = range('A', 'Z');
        @endphp
        @foreach ($alphabets as $alphabet)
            <a href="#brand-{{$alphabet}}">{{$alphabet}}</a>
        @endforeach

        @foreach ($alphabets as $alphabet)
            <div class="my-8">
                <!-- Separator -->
                <div class="my-4 border-b-2 border-gray-300"></div>

                <!-- Alphabet Heading -->
                <h2 id="brand-{{ $alphabet }}" class="text-xl font-semibold">{{ $alphabet }}</h2>

                <!-- Check if there are any brands under the current alphabet -->
                @if (isset($groupedBrands[$alphabet]))
                    <!-- Apply CSS columns for vertical layout -->
                    <div class="columns-1 sm:columns-2 lg:columns-4">
                        <ul class="list-none">
                            @foreach ($groupedBrands[$alphabet] as $brand)
                                <li class="my-1">
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
            </div>
        @endforeach
    </div>
</x-app-layout>