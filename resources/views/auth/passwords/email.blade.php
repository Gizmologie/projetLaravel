@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">

                        <h5 class="card-title text-center">Connexion</h5>
                        <form method="post" action="{{ route('resetPasswordWithToken') }}">
                            @csrf
                            <div class="form-label-group">
                                <input id="email"  id="inputEmail" type="email" class="form-control" name="email"  required autofocus>
                                <label for="inputEmail">Adresse mail</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Envoyer le mail</button>
                            <hr class="my-4">
                        </form>
                    </div>
                    @include('components.form.errors')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style>

</style>
