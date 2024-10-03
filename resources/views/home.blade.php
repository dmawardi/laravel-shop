<x-app-layout title="Discover Premium Makeup, Skincare, Hair & Beauty Products | Mona" 
description="Welcome to Mona, your destination for top makeup, skincare, hair, and beauty products. Explore our curated collections from trusted brands to elevate your beauty routine." 
keywords="makeup, skincare, hair care, beauty products, beauty store, beauty collections" canonical="url('/')">
    <x-products.carousel></x-carousel>
    <x-products.collection-row :products="$products" title="Featured Products"></x-collection-row>
    <x-products.collection-row :products="$products" title="New Releases"></x-collection-row>
    <x-products.collection-row :products="$products" title="Rewards" subtitle="Sign in to redeem points"></x-collection-row>
    <x-products.promo-row></x-promo-row>
</x-app-layout>
