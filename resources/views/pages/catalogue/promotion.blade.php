@extends('layouts.base')



@section('styles')
    <link rel="stylesheet" href="{{ asset('css/product-list.css') }}">
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-3 d-none d-md-block">
{{--            @include('partials.catalogue.list_form')--}}
        </div>
        <div class="col-12 col-md-9">
            @foreach($products as $product)
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card-deck">
                            {{$product->name}}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 text-center">
{{--                    {!! $paginator->links() !!}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
