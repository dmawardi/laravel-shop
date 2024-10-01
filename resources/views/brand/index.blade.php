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
                    <ul class="list-disc pl-5">
                        @foreach ($groupedBrands[$alphabet] as $brand)
                            <li>{{ $brand->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No brands starting with {{ $alphabet }}.</p>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>