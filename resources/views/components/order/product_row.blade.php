<div class="card card-border-none shadow mb-3" id="product-line-{{ $line['product']['id'] }}">
    <div class="card-body p-1">
        <div class="row p-2">
            <div class="col-3 cart-img-container">
                <img class="img-fluid my-auto" src="{{ asset($line['product']['image']) }}" alt="{{ $line['product']['name'] }}">
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title ">
                            {{ $line['product']['name'] }}
                            @if($line['quantity'] > 1)
                                (x{{ $line['quantity'] }})
                            @endif
                        </h4>
                        <span class="">{{ $line['product']['price'] }} €</span>
                    </div>
                    <div class="col-3 text-right">
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-comments fa-2x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('storeComment', ['product_id' => $line['product']['id']])}}" data-product="{{$line['product']['id']}}" id="comment-add">
                    @csrf
                    <input type="hidden" value="{{ $line['product']['id'] }}">
                    <div class="form-group row mx-0">
                        <p class="col-12">Laisse un commentaire sur ce produit</p>

                        <input type="text" class="form-control comment col-sm-6" name="title" placeholder="titre" required>
                        <input type="number" class="form-control comment offset-sm-1 col-sm-2" placeholder="note" name="rate" required>
                        <textarea type="text" class="form-control col-sm-12 mt-4" name="content" placeholder="commentaire" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="js-submit-comment-form">Commenter</button>
                    @include('components.form.errors')
                </form>
            </div>

        </div>
    </div>
</div>

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/comment.js') }}"></script>
@show
