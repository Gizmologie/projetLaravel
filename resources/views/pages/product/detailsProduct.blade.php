@extends('layouts.base')

@section('content')
    <div class="card my-3">
        <div class="row my-3">
            <div class="col-sm-4">
                <a><img class="card-img-top" height="300" width="300" src="{{ $product->getImage() }}" alt="{{ $product->name }}"></a>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="offset-sm-3 col-sm-7 my-5"><b>{{$product->name}}</b></div>
{{--                    <div class="offset-sm-3 col-sm-7">{{$product->getCategory->name}}</div>--}}
                    <div class="offset-sm-3 col-sm-7 ">Aucun avis pour le moment</div>
                </div>
                <br><br>
                <div class="row">
                    <div class="offset-sm-3 col-sm-4"><strong>Prix : </strong>{{$product->price}}</div>
                    <div class="col-sm-2">
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
                {{--        <div>{{$product->technical_description}}</div>--}}
            </div>
        </div>


    </div>


    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <br>

                @include('pages.product.commentModal')
                <br>
                {{-- Comment section --}}
                <section class="comment-list">
                    <!-- First Comment -->
                    @foreach($comments as $comment)
                        <article class="row">
                            <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure>
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center">{{$comment->user->name}}</figcaption>
                                </figure>
                                @if($comment->user_id == \Illuminate\Support\Facades\Auth::id())
                                    <form action="{{route('deleteComment', ['id' => $comment->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger mr">
                                            <span class="icon icon-cross"></span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow left">
                                    <div class="panel-body">
                                        <header class="text-left">
                                            <div class="comment-user"><i class="fa fa-user"></i> {{$comment->title}}</div>
                                            <time class="comment-date">
                                                <i class="fa fa-clock-o"></i> {{$comment->created_at->format('d/m/Y à H:m')}}
                                            </time>
                                            <div class="stars">
                                                @for($star = 0; $star<$comment->rate; $star++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                @for($emptyStar = 5; $emptyStar>$comment->rate; $emptyStar--)
                                                    <span class="fa fa-star"></span>
                                                @endfor
                                            </div>
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
                {{-- Fin comment section --}}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/cart_update.js') }}"></script>
@endsection
