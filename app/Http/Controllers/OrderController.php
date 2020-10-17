<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Enum\CartStateEnum;
use App\Enum\OrderStateEnum;
use App\Http\Requests\OrderDeliveryInformations;
use App\Order;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * OrderController constructor.
     * @param StripeService $stripeService
     */
    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
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
        $order = $this->getOrder();

        if (!$order instanceof Order){
            return $order;
        }

       if ($request->get('state') === 'success'){
            $order->cart()->update([
                'state' => CartStateEnum::$ORDERED
            ]);
            $order->update([
                'state' => OrderStateEnum::$DELIVERY_IN_PROCESS
            ]);
       }else{
           $order->cart()->update([
               'state' => CartStateEnum::$CREATED
           ]);

           $order->delete();
       }

       dump('TODO : redirection sur le suivi');
       die;

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
        return ['id' => $this->stripeService->payement($order, [
            'success_url' => route('orderStep3', ['state' => 'success']),
            'cancel_url' => route('orderStep3', ['state' => 'cancel']),
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

        $cart = Cart::where('user_id','=', $user->id)->where('state', '!=', CartStateEnum::$ORDERED)->first();

        if (!$cart){
            return redirect()->route('cart');
        }

        /** @var Order $order */
        $order = Order::where('cart_id', '=', $cart->id)->first();

        if (!$order){
            $order = Order::create([
                'cart_id' => $cart->id,
                'state' => OrderStateEnum::$CREATED,
                'price' => $cart->getTotal()
            ]);

            $cart->update([
                'state' => CartStateEnum::$ORDER_STARTED
            ]);
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
