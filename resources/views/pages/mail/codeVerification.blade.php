@extends('layouts.base')
@section('content')
    <div class="offset-sm-3 col-sm-6" style="margin-top: auto; margin-bottom: auto;">
        <div class="card">
            <div>Saisissez le code</div>
            <div>Un email contenant le code de validation a été envoyé à {{$email}}</div>
            <input class="form-control">
        </div>
    </div>
@endsection
