@props(['brands'=>[], 'category'=>null, 'routeAction'=>''])
<aside class="w-full md:w-1/4 mb-8 md:mb-0">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="font-semibold text-lg mb-4">Filters</h2>
                <!-- Example Filters -->
                <form action="" method="GET">
                    <!-- Price Filter -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Price</h3>
                        <input type="text" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full mb-2 p-2 border rounded">
                        <input type="text" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full p-2 border rounded">
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Brand</h3>
                        @foreach($brands as $brand)
                            <div>
                                <input type="checkbox" id="brand-{{ $brand }}" name="brands[]" value="{{ $brand }}">
                                <label for="brand-{{ $brand }}">{{ $brand->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Apply Filters Button -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>