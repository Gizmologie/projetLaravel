@if($product)
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="{{ $product['picture'] }}" alt="{{ $product['name'] }}"></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#">{{ $product['name'] }}</a>
            </h4>
            <h5>{{ $product['price'] }}</h5>
            <p class="card-text">{{ $product['resume'] }}</p>
        </div>
    </div>
@else
    <div class="card h-100" style="visibility: hidden">
    </div>
@endif
