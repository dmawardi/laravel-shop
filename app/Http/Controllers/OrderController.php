<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
        // Get the cart session
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        // Create a new order
        $order = [
            'order_number' => 'ORD-'.strtoupper(uniqid()),
            'items' => $cart,
            'total' => array_sum(array_column($cart, 'subtotal')),
            'status' => 'pending',
        ];

        // Save the order to the database
        // Order::create($order);

        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    }
}
