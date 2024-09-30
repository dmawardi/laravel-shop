@props(['dataID'])
<div class="dropdown-content absolute w-screen top-full left-0 right-0 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 hidden z-50"
                data-nav-id="{{ $dataID }}"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                {{ $slot }}
</div>