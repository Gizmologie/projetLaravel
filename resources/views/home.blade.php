@extends('layouts.base')

@section('content')


    <div class="row">
        @foreach($products as $product)

            <div class="col-md-4">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Name : {{ $product->name }}</h5>
                                <p class="card-text">Shortname : {{ $product->shortname }}</p>
                                <p class="card-text">Description : {{ $product->fonctional_description }}</p>
                                <p class="card-text">Prix : {{ $product->price }}€</p>
                                <p class="card-text">Stock : {{ $product->stock_quantity }}</p>
                                <p class="card-text">Disponible le : {{ $product->available_at }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/'.$product->image) }}" height="300" width="200" default="pas d'image">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection
