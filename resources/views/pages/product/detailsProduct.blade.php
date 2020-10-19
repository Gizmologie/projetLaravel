@extends('layouts.base')

@section('content')
    <div class="card my-3">
        <div class="row my-3">
            <div class="col-sm-4">
                <a><img class="card-img-top" height="300" width="300" src="{{ $product->getImage() }}" alt="{{ $product->name }}"></a>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="offset-sm-3 col-sm-7 my-5" style="background-color: #F7F7F7"><b>{{$product->name}}</b></div>
{{--                    <div class="offset-sm-3 col-sm-7">{{$product->getCategory->name}}</div>--}}
                    <div class="offset-sm-3 col-sm-7" style="background-color: #F7F7F7">Aucun avis pour le moment</div>
                </div>
                <br><br>
                <div class="row" >
                    <div class="offset-sm-3 col-sm-4" style="background-color: #F7F7F7">
                        <strong >Prix : </strong>
                        @if(isset($product->promotion))
                          <span class="h5">{{$product->price}}€</span> <del class="ml-3">{{$product->base_price}}</del>
                        @else
                            <span class="h5">{{$product->price}}€</span>
                        @endif
                    </div>
                    <div class="col-sm-3" style="background-color: #F7F7F7">
                        @if($product->stock_quantity==0)
                            <p><strong>Rupture de stock</strong></p>
                        @else
                            <p><strong>Stock :</strong> {{$product->stock_quantity}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12 my-5">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active technical" id="technical">Technique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link functional" id="functional">Fonctionnelle</a>
                    </li>
                </ul>
                <div id="functional_description"  style="display: none;">
                    <div  class="col">
                        <br>
                        <div>
                            {{ $product->functional_description }}
                        </div>
                    </div>
                </div>
                <div id="technical_description"  style="display: block;">
                    <div  class="col">
                        <br>
                        <div>
                            {{ $product->technical_description }}
                        </div>
                    </div>
                </div>
                <br><br>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="action  d-flex justify-content-center">
                        <button class="add-to-cart btn btn-warning js-add-to-cart rounded-pill" data-product="{{ $product->id }}" type="button">
                            Ajouter au panier
                            @if($total)
                                ({{ $total }} actuellement)
                            @endif
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('pages.product.commentModal')
    @include('pages.product.comment')
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/cart_update.js') }}"></script>
@endsection
