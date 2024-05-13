<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class CartController extends Controller
{
    public function store(Request $request)
    {
        
        // Get the cart session
        $cart = session()->get('cart', []);
        // Calculate the item subtotal
        $itemSubtotal = $request->price * ($request->quantity ?? 1); // Default quantity is 1 if not specified

        // Check if the item is already in the cart
        if (isset($cart[$request->id])) {
            // Update the quantity and subtotal
            $cart[$request->id]['quantity'] += ($request->quantity ?? 1);
            $cart[$request->id]['subtotal'] = $cart[$request->id]['quantity'] * $request->price;
        } else {
            // Add the item to the cart
            $cart[$request->id] = [
                "id" => $request->id,
                "name" => $request->name,
                "quantity" => $request->quantity ?? 1,
                "price" => $request->price,
                "image" => $request->image,
                "subtotal" => $itemSubtotal
            ];
        }
        // Update the cart session
        session()->put('cart', $cart);

        Alert::success('Success', 'Product added to cart successfully!');
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        return view('cart.index', ['cart' => session()->get('cart')]);
    }

    public function update(Request $request, $id)
    {
        // Get the cart session
        $cart = session()->get('cart');

        // Update the item in the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        }

        // Update the cart session
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        // Get the cart session
        $cart = session()->get('cart');
        // Remove the item from the cart
        unset($cart[$id]);
        // Update the cart session
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }

    public function checkout()
    {
        return view('cart.checkout');
    }
}
