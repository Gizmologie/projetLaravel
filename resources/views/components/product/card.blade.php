@if($product)
    <div class="card border-0 text-center card-link">
        <a href="{{route('productDetails', ['slug' => $product->slug, 'category' => $product->getCategory()->slug])}}">
            <img class="" @if(isset($small))width="45%" @else width="100%" @endif src="{{ $product->getImage() }}" alt="{{ $product->name }}">
            <div class="card-body">
                <div class= card-title" style="color: black">
                @if(isset($small))
                    <h5>{{ $product->name }}</h5>
                @else
                    <h4>{{ $product->name }}</h4>
                @endif
            </div>
            <div style="color: #265c78">

                @if($product->promotion > 0)
                    <del style="font-size: 15px">{{ $product->base_price }} €</del>
                    <span style="font-size: 20px">{{ $product->price  }} €</span>
                @else
                    <span style="font-size: 20px">{{ $product->price }} €</span>
                @endif
            </div>
    </div>
    </a>
    </div>
@else
    <div class="card h-100" style="visibility: hidden">
    </div>
@endif
