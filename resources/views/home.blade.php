<x-app-layout>
    <x-products.carousel></x-carousel>
    <x-products.collection-row :products="$products" title="Featured Products"></x-collection-row>
    <x-products.collection-row :products="$products" title="New Releases"></x-collection-row>
    <x-products.collection-row :products="$products" title="Rewards" subtitle="Sign in to redeem points"></x-collection-row>
    <x-products.promo-row></x-promo-row>
</x-app-layout>
