@extends('layouts.base')

@section('content')

    <div class="row pt-5">
        <div class="col-12 text-center mb-5">
            <h3 class="text-uppercase">Commande n°{{ $order->id }}</h3>
        </div>
        <div class="col-12 order-1 order-md-1 col-md-8">
            @foreach($order->getLines() as $line)
                @include('components.order.product_row')
            @endforeach
        </div>
        <div class="col-12 col-md-4 order-0 order-md-1">
            <div class="row">
                <div class="col-12">
                    @include('components.order.delivery_state')
                </div>
                <div class="col-12 text-center mt-4">
                    <a href="{{ route('userOrderDownload', ['id' => $order->id]) }}" class="btn btn-primary">Télécharger le résumé</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection
