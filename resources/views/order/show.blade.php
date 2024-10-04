<x-app-layout title="View Your Order #{{ $order->id }} | Mona" 
description="Review the details of your Order #{{ $order->id }} at Mona. Track your items, view shipping information, and manage your purchase history." 
keywords="order {{ $orderNumber }}, view order details, track order, Mona order status, beauty purchases, makeup orders, skincare orders" 
canonical="{{ route('order.show'), order->id }}">
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Order Details
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Personal details and application.
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    {{-- Personal Details --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Full name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $order->buyer->name }}
                        </dd>
                    </div>
                    {{-- Payment Method --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Payment Method
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $order->payment->payment_method }}
                        </dd>
                    </div>
                    {{-- Shipping Address --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Shipping Address
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $order->shippingInformation->address_line1 }},
                            {{ $order->shippingInformation->address_line2 ? $order->shippingInformation->address_line2 . ',' : '' }}
                            {{ $order->shippingInformation->city }},
                            {{ $order->shippingInformation->state }},
                            {{ $order->shippingInformation->country }}
                            {{ $order->shippingInformation->postal_code }}
                        </dd>
                    </div>
                    {{-- Order Items --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Items Ordered
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} ({{ $item->quantity }} x
                                        ${{ number_format($item->price, 2) }})
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                    {{-- Total Amount --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Total Amount
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            ${{ number_format($order->total, 2) }}
                        </dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>
    {{-- Payment instructions --}}
    <div class="w-full lg:w-4/12 mx-auto px-6">
        @if ($order->payment->payment_method === 'credit_card')
            <h3 class="font-medium">Payment Information</h3>
            @include('form._ccpayment')
        @endif
    </div>
</x-app-layout>
