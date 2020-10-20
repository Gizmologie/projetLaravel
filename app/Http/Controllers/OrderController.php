<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Enum\OrderStateEnum;
use App\Http\Requests\OrderDeliveryInformations;
use App\Order;
use App\Services\MailerService;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var StripeService
     */
    private $stripeService;
    /**
     * @var MailerService
     */
    private $mailerService;

    /**
     * OrderController constructor.
     * @param StripeService $stripeService
     * @param MailerService $mailerService
     */
    public function __construct(StripeService $stripeService, MailerService $mailerService)
    {
        $this->stripeService = $stripeService;
        $this->mailerService = $mailerService;
    }

    public function step1(Request $request){
        $this->request = $request;
        $order = $this->getOrder();

        if (!$order instanceof Order){
            return $order;
        }

        $order->update([
            'state' => OrderStateEnum::$DELIVERY_SETUP
        ]);

        return view('pages.order.step1')
            ->with('order', $order)
            ->with('active', 1)
            ->with('deliveryTypes', $this->getDeliveryTypes())
            ;
    }

    public function step1Confirm(OrderDeliveryInformations $request){
        $this->request = $request;
        $order = $this->getOrder();

        if (!$order instanceof Order){
            return $order;
        }

        $order->update([
            'delivery_name' => $request->validated()['name'],
            'delivery_address' => $request->validated()['address'],
            'delivery_city' => $request->validated()['city'],
            'delivery_zipCode' => $request->validated()['zipCode'],
            'delivery_type' => $request->validated()['deliveryType'],
            'delivery_price' => $this->getDeliveryTypes($request->validated()['deliveryType'])['price'],
            'state' => OrderStateEnum::$BILLING_SETUP
        ]);

       return redirect()->route('orderStep2');
    }

    public function step2(Request $request){
        $this->request = $request;
        $order = $this->getOrder();

        if (!$order instanceof Order){
            return $order;
        }

        return view('pages.order.step2')
            ->with('order', $order)
            ->with('active', 2)
            ->with('publicKey', $this->stripeService->getPk())
            ;
    }

    public function step3(Request $request){
        $this->request = $request;
        $order = Order::where('hash', '=', $request->get('token', -1))->first();

        if (!$order instanceof Order){
            return $order;
        }

       if ($request->get('state') === 'success'){
           if ($order->state !== OrderStateEnum::$ACCEPTED){
               $this->mailerService->sendMail(
                   ['Email' => 'benjamin.robert90@gmail.com', 'Name' => $order->user()->name],
                   'Commande n°' . $order->id,
                   'mails.orderSuccess', ['order' => $order]
               );
           }
            $order->update([
                'state' => OrderStateEnum::$ACCEPTED
            ]);
       }else{
           return redirect()->route('orderStep2');
       }


        return view('pages.order.step3')
            ->with('order', $order)
            ->with('active', 3)
            ;
    }

    public function session(Request $request){
        $this->request = $request;
        $order = $this->getOrder();

        if (!$order instanceof Order){
            return $order;
        }
        return ['id' => $this->stripeService->checkout($order, [
            'success_url' => route('orderStep3', ['state' => 'success', 'token' => $order->hash]),
            'cancel_url' => route('orderStep3', ['state' => 'cancel', 'token' => $order->hash]),
        ])];
    }

    /**
     * @return RedirectResponse|Order
     */
    private function getOrder(){
        $user = $this->request->user();

        if (!$user){
            return redirect()->route('login');
        }

        /** @var Order $order */
        $order = Order::where('user_id','=', $user->id)->whereIn('state', [OrderStateEnum::$CREATED, OrderStateEnum::$DELIVERY_SETUP, OrderStateEnum::$BILLING_SETUP, OrderStateEnum::$ACCEPTED])->first();

        if (!$order){

            $cart = Cart::where('user_id', '=', $user->id)->first();

            if (!$cart){
                return redirect()->route('cart');
            }

            $order = Order::create([
                'user_id' => $user->id,
                'state' => OrderStateEnum::$CREATED,
                'lines' => Order::createLines($cart->lines()->get()),
                'price' => $cart->getTotal(),
                'hash' => Hash::make(uniqid())
            ]);

            $cart->delete();
        }

        return $order;
    }

    private function getDeliveryTypes($type = null){
        $types = [
            'chronopost' => [
                'label' => 'Chronopost (Express)',
                'price' => 14.99,
                'logo' => 'chronopost.png'
            ],
            'ups' => [
                'label' => 'Ups',
                'price' => 7.99,
                'logo' => 'ups.png'
            ]
            ,
            'mondial-relay' => [
                'label' => 'Mondial Relay',
                'price' => 5.99,
                'logo' => 'mondial-relay.png'
            ]
        ];

        if ($type && isset($types[$type])){
            return $types[$type];
        }

        return $types;
    }
}
