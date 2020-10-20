@extends('layouts.base')
@section('content')
    <div class="offset-sm-3 col-sm-6">
        <div class="card">
            <div class="row my-3">
                <div class="col-sm-12">
                    <div>Saisissez le code</div>
                </div>
                <div class="col-sm-12">
                    <div>Un email contenant le code de validation a été envoyé à {{$email}}</div>

                    <form method="post" action="">
                        @csrf
                    <input class="form-control">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

