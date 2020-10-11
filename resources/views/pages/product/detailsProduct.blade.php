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
                        <button class="add-to-cart btn btn-warning" type="button">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <br>
            {{--  Ajouter un commentaire          --}}
            <form method="post" action="">
                @csrf
                <div class="form-group">
                    <label>Commentaire</label>
                    <input type="text" class="form-control col-sm-4" name="title" placeholder="titre" required>
                    <textarea type="text" class="form-control col-sm-10" name="content" placeholder="commentaire" required></textarea>
                    <button type="submit" class="btn btn-primary">+</button>
                    @include('components.errors')
                </div>
            </form>


            <section class="comment-list">
                <!-- First Comment -->
                @foreach($comments as $comment)
                <article class="row">
                    <div class="col-md-2 col-sm-2 hidden-xs">
                        <figure>
                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                            <figcaption class="text-center">{{$comment->user->name}}</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                            <div class="panel-body">
                                <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i> {{$comment->title}}</div>
                                    <time class="comment-date">
                                        <i class="fa fa-clock-o"></i> {{$comment->available_at}}
                                    </time>
                                </header>
                                <br>
                                <div class="comment-post form-control">
                                    <p>{{$comment->content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                    <br>
                @endforeach
            </section>
        </div>
    </div>
</div>
@endsection

