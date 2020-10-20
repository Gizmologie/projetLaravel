@if($product)
    <div class="card border-0 text-center card-link">
        <a href="{{route('productDetails', ['slug' => $product->slug, 'category' => $product->getCategory()->slug])}}">
            <figure class="figure  @if($product->promotion > 0) tag tag-promotion-{{substr($product->promotion, 0, 1)}} @endif">
                <img class="rounded" @if(isset($small)) width="45%" @else width="100%" @endif src="{{ $product->getImage() }}" alt="{{ $product->name }}">
            </figure>
            <div class="card-body">
                <div class="card-title text-secondary" style="color: black">
                    <h6>{{ $product->name }}</h6>
                </div>
                <div style="color: #265c78">
                    @if($product->promotion > 0)
                        <span style="font-size: 20px">{{ $product->price  }} €</span><br>
                        <del style="font-size: 15px">{{ $product->base_price }} €</del>
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
