@extends('pages.order.base')

@section('process')
    <form method="post" action="{{ route('orderStep1Confirm') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                @include('components.form.errors')

            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow card-border-none">
                    <div class="card-body row">
                        @foreach($deliveryTypes as $key => $type)
                            <div class="col-3">
                               <div class="row">
                                   <div class="col-12 text-center">
                                       <img width="50px" src="{{ asset('/images/deliveryTypes/' . $type['logo']) }}" class="img-fluid" alt="">
                                   </div>
                                   <div class="col-12 text-center">
                                       {{ $type['price'] }} €
                                   </div>
                                   <div class="col-12 text-center">
                                      <input type="radio" @if(old('deliveryType') == $type['price']) checked="checked"@endif name="deliveryType" value="{{ $key }}">
                                   </div>
                               </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow card-border-none">
                    <div class="card-body">
                        <div class="form-group">
                            @include('components.form.input', ['label' => 'Nom - Prénom', 'name' => 'name', 'value' => $order->delivery_name !== "" ? $order->delivery_name :  old('name')])
                        </div>
                        <div class="form-group">
                            @include('components.form.input', ['label' => 'Adresse', 'name' => 'address', 'value' => $order->delivery_address !== "" ? $order->delivery_address : old('address')])
                        </div>
                        <div class="form-group">
                            @include('components.form.input', ['label' => 'Code Postal', 'name' => 'zipCode', 'value' => $order->delivery_zipCode !== "" ? $order->delivery_zipCode : old('zipCode')])
                        </div>
                        <div class="form-group">
                            @include('components.form.input', ['label' => 'Ville', 'name' => 'city', 'value' => $order->delivery_city !== "" ? $order->delivery_city : old('city')])
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection()

@section('next')
@endsection
