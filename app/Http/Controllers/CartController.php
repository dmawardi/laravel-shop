<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Orchid\Support\Facades\Alert;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'variant_id' => 'nullable|integer|exists:product_variants,id', // Optional variant ID
            'quantity' => 'nullable|integer|min:1',                // Default is 1 if not specified
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->with('fail', 'Failed to add product to cart!');
        }

        // Retrieve the product
        $product = Product::find($request->product_id);

        // Check if a variant is provided, else use the product's base price
        $price = $product->price;
        $variant = null;
        if ($request->variant_id) {
            $variant = ProductVariant::find($request->variant_id);
            $price += $variant->additional_price; // Add variant price to base price
        }

        // Calculate the quantity (default to 1 if not provided)
        $quantity = $request->quantity ?? 1;

        // Calculate the subtotal for this item
        $itemSubtotal = $price * $quantity;
        
        // Get the cart from session (initialize if empty)
        $cart = session()->get('cart', []);

        // Create a unique cart item identifier based on product ID and variant (if exists)
        $cartItemKey = $variant ? $product->id . '-' . $variant->id : $product->id;
 
        // Check if the item is already in the cart
        if (isset($cart[$cartItemKey])) {
            // If the product already exists in the cart, update the quantity and subtotal
            $cart[$cartItemKey]['quantity'] += $quantity;
            $cart[$cartItemKey]['subtotal'] = $cart[$cartItemKey]['quantity'] * $price;
        } else {
            // Add the new product to the cart
            $cart[$cartItemKey] = [
                'product_id' => $product->id,
                'variant_id' => $variant ? $variant->id : null,  // Store variant if available
                'name' => $product->name,
                'variant_name' => $variant ? $variant->variant_value : null, // Optional variant name (e.g., "Red Matte")
                'quantity' => $quantity,
                'price' => $price, // Price per unit (with variant if applicable)
                'image' => $product->image,  // Assuming the product has an image
                'subtotal' => $itemSubtotal, // Total price for this item
            ];
        }

        // Update the cart session
        session()->put('cart', $cart);

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
        // Check if user is logged in, if not send to login page
        if (!auth()->check()) {
            return redirect()->route('login')->with('fail', 'You need to login to checkout');
        }
        // Else, proceed to checkout
        return view('cart.checkout');
    }
}
