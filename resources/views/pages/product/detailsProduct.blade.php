@extends('pages.product.base')

@section('content')

<div class="container">
    <a href="{{route('home')}}" type="button"  class="btn btn-primary">Retour</a>
    <div class="card" style="background: #eee">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="{{$product->image}}" alt="Image not found" /></div>
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                    </ul>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{$product->name}}</h3>
                    <div class="rating">
                        {{--
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>--}}
                        <span class="review-no"></span>
                    </div>

                    <h5>Description Fonctionelle</h5>
                    <p class="product-description">{{$product->functional_description}}</p>

       {{--         <h5>Description Technique</h5>
                    <p class="product-description">{{$product->technical_description}}</p>
--}}
                    <h4 class="price">Prix : <span>{{$product->price}}</span></h4>

                    @if($product->stock_quantity==0)
                        <p><strong>Rupture de stock</strong></p>
                    @else
                        <p><strong>Stock :</strong> {{$product->stock_quantity}}</p>
                    @endif
                    <div class="action">
                        <button class="add-to-cart btn btn-warning" type="button">Commenter</button>
                    </div>
                </div>

                <div class="row">
                    @foreach($comments as $comment)
                        <div>{{$comment->title}}</div>
                        <div>{{$comment->content}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($comments as $comment)
        <div>{{$comment->title}}</div>
        <div>{{$comment->content}}</div>
    @endforeach
</div>
@endsection
