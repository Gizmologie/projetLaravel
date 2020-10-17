<?php

namespace App\Services;

use App\Cart;
use App\CartLine;
use App\Order;
use Illuminate\Http\Response;
use Stripe\Checkout\Session;
use Stripe\StripeClient;
use Symfony\Component\HttpFoundation\Request;

class StripeService
{
    /**
     * @var StripeClient
     */
    private $stripeClient;

    /**
     * StripeService constructor.
     */
    public function __construct()
    {
        $this->stripeClient = new StripeClient(config('stripe.STRIPE_SECRET'));
    }

    public function getPk()
    {
        return config('stripe.STRIPE_PUBLIC');
    }

    public function payement(Order $order, array $redirect)
    {
        $payment = $this->stripeClient->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => ($order->price + $order->delivery_price) * 100,
                    'product_data' => [
                        'name' => 'Commande n°' . $order->id,

                    ],
                ],
                'quantity'   => 1,
            ]],
            'mode'                 => 'payment',
            'customer_email' => $order->cart()->first()->user()->email,
            'success_url'          => $redirect['success_url'],
            'cancel_url'           => $redirect['cancel_url'],
        ]);

        return $payment->id;
    }
}
