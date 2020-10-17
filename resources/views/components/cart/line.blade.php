<div class="card card-border-none shadow mb-3" id="product-line-{{ $line->product->id }}">
    <div class="card-body p-1">
        <div class="row p-2">
            <div class="col-3 cart-img-container">
                <img class="img-fluid my-auto" src="{{ asset($line->product->image) }}" alt="{{ $line->product->name }}">
            </div>
            <div class="col-5">
                <h4 class="card-title ">
                    {{ $line->product->name }}
                    @if(isset($canEdit) && !$canEdit && $line->quantity > 1)
                        (x{{ $line->quantity }})
                    @endif
                </h4>

                <p>
                    {{ $line->product->price }} €
                </p>
            </div>
            @if(!isset($canEdit) || $canEdit)
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
            @endif
        </div>
    </div>
</div>
