@if($product)
    <div class="card">
        <a href="#"><img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}"></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#">{{ $product->name }}</a>
            </h4>
            @if($product->promotion > 0)
                <del style="font-size: 15px">{{ $product->base_price }} €</del>
                <span style="font-size: 20px">{{ $product->price  }} €</span>
            @else
                <span style="font-size: 20px">{{ $product->price }} €</span>
            @endif
            <p class="card-text">{{ $product->resume }}</p>
        </div>
    </div>
@else
    <div class="card h-100" style="visibility: hidden">
    </div>
@endif
