<!-- Allow for css to be added to using attributes -->
<div class="py-4 px-6 my-auto {{ $attributes->get('class') }}">
    {{ $slot }}
</div>