@props(['id', 'details'])
<div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 flex">
    <x-cart.table-data class="w-1/12">
        <input type="checkbox" name="selected[]" value="{{ $id }}" class="form-checkbox h-5 w-5 text-blue-600">
    </x-cart.table-data>
    <x-cart.table-data class="w-1/12">
        <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-10 h-10 object-cover">
    </x-cart.table-data>
    <x-cart.table-data class="w-10/12">
        <div>
            {{ $details['name'] }}
        </div>
        <div class="flex justify-between">
            <div class="w-1/2 mt-auto">
                ${{ number_format($details['price'], 2) }}
            </div>
            <div class="w-1/2 flex flex-row justify-end">
                <form id="update-delete-form-{{ $id }}" action="{{ route('cart.update', $id) }}" method="POST" class="flex align-bottom">
                    @csrf
                    @method('PATCH') <!-- This will be used for updates -->
                    
                    <!-- Delete button -->
                    <button formaction="{{ route('cart.destroy', $id) }}" formmethod="POST" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-2 py-1">
                        @csrf
                        @method('DELETE') <!-- This is specifically for deletion -->
                        X
                    </button>

                    <!-- Update quantity -->
                    <select name="quantity" class="text-center w-16 ml-2" onchange="updateCart('{{ $id }}', this.value)">
                        @for($i = 1; $i <= 10; $i++) <!-- Replace 10 with the max quantity limit if needed -->
                            <option value="{{ $i }}" {{ $details['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </form>
            </div>
        </div>
    </x-cart.table-data>
</div>
<script>
    function updateCart(id, quantity) {
        // Get the form element
        const form = document.getElementById(`update-delete-form-${id}`);
        const formData = new FormData(form);

        // Set the quantity in formData
        formData.set('quantity', quantity);

        // Make the PATCH request using fetch API
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Reload the page after the update
            window.location.reload();
        })
        .catch(error => {
            console.error('There was a problem with the update request:', error);
        });
    }
</script>
