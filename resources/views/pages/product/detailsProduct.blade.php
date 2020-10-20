@extends('layouts.base')

@section('content')

    <div class="row pt-5" id="product">
        <div class="col-12 col-lg-6 text-center">
            <img class="img-fluid" src="{{ $product->getImage() }}" alt="{{ $product->name }}">
        </div>
        <div class="col-12 col-lg-6 pt-2">
            <hr class="mx-auto">
            <h2 class="text-center mb-1">{{ $product->name }}</h2>
            <div class="text-center">
                <small class="text-secondary">{{ $product->getCategory()->name }}</small>
            </div>
            @if($product->stock_quantity==0)
                <div class="text-center pt-2">
                    <span class="badge badge-danger">Rupture de stock</span>
                </div>
            @endif
            <div class="text-center pt-4" style="color: #265c78">
                @if(isset($product->promotion))
                    <span class="h4">{{$product->price}}€</span><br>
                    <del class="">{{$product->base_price}}</del>
                @else
                    <span class="h4">{{$product->price}}€</span>
                @endif
            </div>
            <div class="text-center pt-3 w-75 mx-auto text-secondary small">
                {{ $product->description }}
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="text-center mt-4">
                    <button class="btn-product-buy w-75 js-add-to-cart" data-product="{{ $product->id }}">
                        Ajouter au panier
                        @if($total)
                            ({{ $total }} actuellement)
                        @endif
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row d-none d-lg-flex" id="info" style="margin-top: 130px; margin-bottom: 30px">
        <div class="col-lg-4 text-center border-right">
            <i class="fas fa-truck text-color fa-lg mb-2"></i>
            <h6>Livraison en 48h</h6>
            <p class="small text-secondary px-5">
                Livraison gratuite en France dès 99€ et en Europe dès 149€
            </p>
        </div>
        <div class="col-lg-4 text-center border-right">
            <i class="fas fa-exchange-alt text-color fa-lg mb-2"></i>
            <h6>Retours gratuits</h6>
            <p class="small text-secondary px-5">
                Un produit ne vous plaît pas ? Vous avez 30 jours pour nous le retourner
            </p>
        </div>
        <div class="col-lg-4 text-center ">
            <i class="fas fa-tags text-color fa-lg mb-2"></i>
            <h6>Meilleurs prix garantis</h6>
            <p class="small text-secondary px-5">
                Trouvez un prix inferieur dans les 7 jours et on vous rembourse la différence
            </p>
        </div>
    </div>

    <div class="row py-5">
        <div class="col-12 text-center mb-4">
            <hr class="mx-auto">
            <h3>Les avis de nos clients</h3>
        </div>
        @foreach($comments as $comment)
            <div class="col-12 col-md-4">
                @include('partials.product.comment')
            </div>
        @endforeach

    </div>

    <div class="row my-5 " id="like">
        <div class="col-12 text-center mb-4">
            <hr class="mx-auto">
            <h3>Vous aimerez aussi</h3>
        </div>
       <div class="col-10 mx-auto">
          <div class="card-deck">
              @foreach($likes as $productLike)
                  @include('components.product.card', ['product' => $productLike])
              @endforeach
          </div>
       </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/cart_update.js') }}"></script>
@endsection
