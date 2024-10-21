<div>
    @if (session('cart') && count(session('cart')) > 0)
    <div class="overflow-x-auto mt-6">
        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <div class="text-xs text-gray-700 uppercase bg-gray-50 flex justify-between border-black border-solid">
                <div class="py-4 px-6">
                    <input type="checkbox" id="select-all" class="form-checkbox h-5 w-5 text-blue-600"> 
                    <span class="mx-2">
                        Select All
                    </span>
                </div>
                <div class="flex align-middle m-4">
                    <button id="delete-selected" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-4 py-2">
                        Delete Selected
                    </button>
                </div>
            </div>
            <div>
                @php $overallTotal = 0; @endphp
                @foreach (session('cart') as $id => $details)
                    @php $overallTotal += $details['subtotal']; @endphp
                        <x-cart.item :id="$id" :details="$details" />
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-4 text-lg font-semibold text-right">
        Total: ${{ number_format($overallTotal, 2) }}
    </div>
    @else
    <p class="mt-6 text-gray-700">Your cart is empty.</p>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the select all checkbox
        const selectAllCheckbox = document.getElementById('select-all');
        // Get all item checkboxes
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        
        // Add event listener to the select all checkbox
        selectAllCheckbox.addEventListener('change', function () {
            const isChecked = this.checked;
            
            // Toggle the state of each item checkbox
            itemCheckboxes.forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        });
        
        
        // Optionally: Handle individual checkbox change events (if needed)
        itemCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                // If any item checkbox is unchecked, uncheck the "select all" checkbox
                if (!this.checked) {
                    selectAllCheckbox.checked = false;
                }

                // If all item checkboxes are checked, check the "select all" checkbox
                if (document.querySelectorAll('.item-checkbox:checked').length === itemCheckboxes.length) {
                    selectAllCheckbox.checked = true;
                }
            });
        });

        document.getElementById('delete-selected').addEventListener('click', function () {
        const selectedIds = [];
        document.querySelectorAll('.item-checkbox:checked').forEach(function (checkbox) {
            selectedIds.push(checkbox.getAttribute('data-id'));
        });

        console.log('Clicking bulk delete', selectedIds);

        if (selectedIds.length > 0) {
            // Send AJAX request for bulk deletion
            fetch('{{ route('cart.bulk-destroy') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to delete selected items.');
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert('No items selected for deletion.');
        }
        });
    });
</script>
