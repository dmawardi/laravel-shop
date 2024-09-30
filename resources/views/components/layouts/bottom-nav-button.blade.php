@props(['link' => '#', 'dataID'=> '', 'label'=> ''])
<div class="relative group">
    <a href="{{ $link }}">
        <button 
        data-nav-id="{{ $dataID }}"
        class="bottom-nav-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-extrabold rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <span>{{ $label }}</span>
        </button>
    </a>
</div>