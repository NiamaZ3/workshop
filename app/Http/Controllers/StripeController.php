<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
//use Strip\

class StripeController extends Controller
{
    //
    public function index(){

        return view('checkout');
    }
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('Stripe_Sk'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://www.linkedin.com/feed/',
            'cancel_url' => 'https://stripe.com/docs/payments/accept-a-payment',
        ]);
  
    return redirect()->away($session->url);
}
public function success()
{
    return view('index');
}

}
