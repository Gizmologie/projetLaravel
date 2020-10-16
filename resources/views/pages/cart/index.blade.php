@extends('layouts.base')

@section('content')
    <div class="row mt-5 pt-5">
    @if($cart && $cart->getNbObjects() > 0)
        <div class="col-lg-7 my-1 order-1 order-md-0">
            <div class="col-12">
                @foreach($cart->lines as $line)
                    <div class="card card-product shadow mb-3" id="product-line-{{ $line->product->id }}">
                        <div class="card-body p-1">
                            <div class="row p-2">
                                <div class="col-3 cart-img-container">
                                    <img class="img-fluid my-auto" src="{{ asset($line->product->image) }}" alt="{{ $line->product->name }}">
                                </div>
                                <div class="col-5">
                                    <h4 class="card-title ">{{ $line->product->name }}</h4>
                                    <p>{{ $line->product->price }} €</p>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="offset-2 col-5 pr-0">
                                            <input type="number" value="{{ $line->quantity }}" class="js-update-product-line form-control" data-product="{{ $line->product->id }}">
                                        </div>
                                        <div class="col-4 pl-2 pt-1">
                                            <a type="submit" class="js-delete-product-line btn btn-danger btn-sm" data-product="{{ $line->product->id }}">
                                                <span class="fas fa-times js-delete-product-line" data-product="{{ $line->product->id }}"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-4 order-sm-2 mt-0 order-0 order-md-1">
            <div class="card card-product">
                <div class="text-center mt-3">
                    <h4>Votre panier</h4>
                </div>
                <div class="row p-2">
                    <div class="col-8 text-left">
                        <strong>
                            Total :
                            <span id="cart-total-objects">{{ $cart->getNbObjects() }}</span>
                            article(s)
                        </strong>
                    </div>
                    <div class="col-4 text-right" >
                        <span id="cart-total-price">{{ $cart->getTotal() }}</span> €
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
