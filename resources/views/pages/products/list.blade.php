@extends('layouts.base')

{{--@section('title')--}}
{{--@endsection--}}

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            @foreach($products as $row)
               <div class="row mb-5">
                    <div class="col-12">
                        <div class="card-deck">
                            @foreach($row as $product)
                                @include('components.product.card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
               </div>
            @endforeach
        </div>
    </div>
@endsection
