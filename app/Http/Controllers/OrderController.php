<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingInformation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     // Get the cart session
    //     $cart = session()->get('cart', []);

    //     // Check if the cart is empty
    //     if (empty($cart)) {
    //         return redirect()->route('products.index')->with('error', 'Your cart is empty!');
    //     }

    //     // Create a new order
    //     $order = [
    //         'order_number' => 'ORD-'.strtoupper(uniqid()),
    //         'items' => $cart,
    //         'total' => array_sum(array_column($cart, 'subtotal')),
    //         'status' => 'pending',
    //     ];

    //     // Clear the cart session
    //     session()->forget('cart');

    //     return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    // }
    public $states = [
        'Aceh',
        'Bali',
        'Banten',
        'Bengkulu',
        'Gorontalo',
        'Jakarta',
        'Jambi',
        'Jawa Barat',
        'Jawa Tengah',
        'Jawa Timur',
        'Kalimantan Barat',
        'Kalimantan Selatan',
        'Kalimantan Tengah',
        'Kalimantan Timur',
        'Kalimantan Utara',
        'Kepulauan Bangka Belitung',
        'Kepulauan Riau',
        'Lampung',
        'Maluku',
        'Maluku Utara',
        'Nusa Tenggara Barat',
        'Nusa Tenggara Timur',
        'Papua',
        'Papua Barat',
        'Riau',
        'Sulawesi Barat',
        'Sulawesi Selatan',
        'Sulawesi Tengah',
        'Sulawesi Tenggara',
        'Sulawesi Utara',
        'Sumatera Barat',
        'Sumatera Selatan',
        'Sumatera Utara',
        'Yogyakarta'
    ];

    public function store(Request $request)
    {
        $request->validate([
            'address_line1' => 'required|string|max:255|min:5',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255|in:' . implode(',', $this->states),
            // 'country' => 'required|string|max:255',
            'postal_code' => 'required|numeric|max:255',
            'payment_method' => 'required|string'
        ]);

        dd(auth()->id());
        $cart = session('cart');
        $subtotal = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax' => $subtotal * 0.1,  // Assuming 10% tax rate
            'shipping_fee' => 15,  // Assuming a flat rate shipping fee
            'total' => $subtotal * 1.1 + 15,
            'payment_status' => 'pending',
            'payment_method' => $request->payment_method
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        ShippingInformation::create([
            'order_id' => $order->id,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
        ]);

        session()->forget('cart');  // Clear the cart after the order is placed

        return redirect()->route('orders.success')->with('success', 'Order placed successfully.');
    }
}
