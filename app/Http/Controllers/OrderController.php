<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingInformation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();

        return view('order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255|min:5',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255|in:' . implode(',', ShippingInformation::$states),
            'country' => 'nullable|string|max:255',
            'postal_code' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        $cart = session('cart');
        $subtotal = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'Pending',
            'subtotal' => $subtotal,
            'tax' => $subtotal * 0.1,  // Assuming 10% tax rate
            'shipping_fee' => 15,  // Assuming a flat rate shipping fee
            'total' => $subtotal * 1.1 + 15,
        ]);

        $orderItems = array_map(function ($item) use ($order) {
            return [
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'subtotal' => $item['price'] * $item['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
            ];
        }, $cart);

        OrderItem::insert($orderItems);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

        ShippingInformation::create([
            'order_id' => $order->id,
            'full_name' => $request->full_name,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => "Indonesia",
            'postal_code' => $request->postal_code,
        ]);

        session()->forget('cart');  // Clear the cart after the order is placed

        // Redirect to the order details page of the newly created order
        return redirect()->route('order.show', $order)->with('success', 'Order created.');
    }

    public function show(Request $request, Order $order)
    {
        // dd($order->id);
        return view('order.show', compact('order'));
    }
}
