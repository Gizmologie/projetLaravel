<div class="card card-border-none shadow mb-3" id="product-line-{{ $line['product']['id'] }}">
    <div class="card-body p-1">
        <div class="row p-2">
            <div class="col-3 cart-img-container">
                <img class="img-fluid my-auto" src="{{ asset($line['product']['image']) }}" alt="{{ $line['product']['name'] }}">
            </div>
            <div class="col-5">
                <h4 class="card-title ">
                    {{ $line['product']['name'] }}
                    @if($line['quantity'] > 1)
                        (x{{ $line['quantity'] }})
                    @endif
                </h4>

                <p>
                    {{ $line['product']['price'] }} €
                </p>
            </div>
        </div>
    </div>
</div>
