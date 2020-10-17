@extends('layouts.base')

@section('content')
    <div class="row mt-5 pt-5">
        @if($cart && $cart->getNbObjects() > 0)
            <div class="col-lg-7 my-1 order-1 order-md-0">
                @foreach($cart->lines as $line)
                    @include('components.cart.line')
                @endforeach
            </div>

            <div class="col-lg-4 order-sm-2 mt-0 order-0 order-md-1">
                <div class="card card-product">
                    <div class="text-center mt-3">
                        <h4>Votre panier</h4>
                    </div>
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-8 text-left">
                                    <strong>
                                        Total :
                                        <span id="cart-total-objects">{{ $cart->getNbObjects() }}</span>
                                        article(s)
                                    </strong>
                                </div>
                                <div class="col-4 text-right">
                                    <span id="cart-total-price">{{ $cart->getTotal() }}</span> €
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center pt-3">
                                    <a href="{{ route('orderStep1') }}" class="btn btn-success">Valider mon panier</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <h3>Votre panier est vide</h3>
            </div>
        @endif
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/cart_update.js') }}"></script>
@endsection
