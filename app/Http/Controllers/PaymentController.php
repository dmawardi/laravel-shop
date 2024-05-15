<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function submit(Request $request)
{
    // Validate credit card details
    $request->validate([
        'card_number' => 'required|numeric',
        'exp_month' => 'required|numeric',
        'exp_year' => 'required|numeric',
        'cvc' => 'required|numeric',
    ]);
    // $token = $request->stripeToken;

    // try {
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // $charge = \Stripe\Charge::create([
        //     'amount' => 1000, // $10, for example
        //     'currency' => 'usd',
        //     'description' => 'Example charge',
        //     'source' => $token,
        // ]);
        return back()->with('success', 'Charge successful!');
    // } catch (\Stripe\Exception\ApiErrorException $e) {
    //     return back()->with('error_message', 'Charge failed!');
    // }
}

}
