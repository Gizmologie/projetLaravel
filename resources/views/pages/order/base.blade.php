@extends('layouts.base')

@section('title')
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-12 text-center">
            @include('components.order.process_state', ['active' => $active])
        </div>
        <div class="col-12">
            <div class="row">
                <div class="@if($active === 3)col-12 @else col-lg-8 @endif my-1 order-1 order-md-0">
                    @section('process')
                    @show
                </div>
                <div class="col-lg-4 order-sm-2 my-1 order-0 order-md-1 @if($active === 3) d-none @endif">
                    <div class="card card-border-none shadow">
                        <div class="text-center mt-3">
                            <h4>Votre commande</h4>
                        </div>
                        <div class="row p-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8 text-left">
                                        <strong>
                                            <span id="cart-total-objects">{{ $order->getNbObjects() }}</span>
                                            article(s)
                                        </strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span id="cart-total-price">{{ $order->getTotal() }}</span> €
                                    </div>
                                </div>
                            </div>
                            @if($order->delivery_name)
                                <div class="col-12 my-2">
                                    <div class="row">
                                        <div class="col-8 text-left">
                                            <strong>
                                                Livraison :
                                            </strong>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span id="cart-total-price">{{ $order->delivery_price }}</span> €
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-8 text-left">
                                            <strong>
                                                Total :
                                            </strong>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span id="cart-total-price">{{ $order->getTotalWithDelivery() }}</span> €
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 text-center pt-3">
                                @section('next')
                                @show
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection()
