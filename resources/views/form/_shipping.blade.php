<div>
    <h3 class="font-medium">Shipping Details</h3>
    {{-- Address 1 --}}
    <x-input-label for="address_line1" value="Address 1" />
    <x-text-input name="address_line1" placeholder="Address 1" class="w-full p-2 border rounded mb-2" required
        :value="old('address_line1')" />
    <x-input-error :messages="$errors->get('address_line1')" />

    {{-- Address 2 --}}
    <x-input-label for="address_line2" value="Address 2" />
    <x-text-input name="address_line2" placeholder="Address 2" class="w-full p-2 border rounded mb-2" :value="old('address_line2')" />
    <x-input-error :messages="$errors->get('address_line2')" />

    {{-- City --}}
    <x-input-label for="city" value="City" />
    <x-text-input name="city" placeholder="City" class="w-full p-2 border rounded mb-2" required :value="old('city')" />
    <x-input-error :messages="$errors->get('city')" />

    {{-- State --}}
    {{-- Selector for Indonesia --}}
    <x-input-label for="state" value="State" />
    <select name="state"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border rounded shadow-sm w-full p-2 mb-2">
        <option value="Aceh">Aceh</option>
        <option value="Bali">Bali</option>
        <option value="Banten">Banten</option>
        <option value="Bengkulu">Bengkulu</option>
        <option value="Gorontalo">Gorontalo</option>
        <option value="Jakarta">Jakarta</option>
        <option value="Jambi">Jambi</option>
        <option value="Jawa Barat">Jawa Barat</option>
        <option value="Jawa Tengah">Jawa Tengah</option>
        <option value="Jawa Timur">Jawa Timur</option>
        <option value="Kalimantan Barat">Kalimantan Barat</option>
        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
        <option value="Kalimantan Timur">Kalimantan Timur</option>
        <option value="Kalimantan Utara">Kalimantan Utara</option>
        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
        <option value="Kepulauan Riau">Kepulauan Riau</option>
        <option value="Lampung">Lampung</option>
        <option value="Maluku">Maluku</option>
        <option value="Maluku Utara">Maluku Utara</option>
        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
        <option value="Papua">Papua</option>
        <option value="Papua Barat">Papua Barat</option>
        <option value="Riau">Riau</option>
        <option value="Sulawesi Barat">Sulawesi Barat</option>
        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
        <option value="Sulawesi Utara">Sulawesi Utara</option>
        <option value="Sumatera Barat">Sumatera Barat</option>
        <option value="Sumatera Selatan">Sumatera Selatan</option>
        <option value="Sumatera Utara">Sumatera Utara</option>
        <option value="Yogyakarta">Yogyakarta</option>
    </select>
    <x-input-error :messages="$errors->get('state')" />

    {{-- Postal Code --}}
    <x-input-label for="postal_code" value="Postal Code" />
    <x-text-input name="postal_code" placeholder="Postal Code" class="w-full p-2 border rounded mb-2" required
        :value="old('postal_code')" />
    <x-input-error :messages="$errors->get('postal_code')" />

</div>
