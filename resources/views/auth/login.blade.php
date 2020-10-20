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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-label-group">
                            <input id="email"  id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="inputEmail">Adresse mail</label>
                        </div>

                        <div class="form-label-group">
                            <input id="password inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <label for="inputPassword">Mot de passe</label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Connexion</button>
                        <hr class="my-4">
                      </form>

                </div>
                @include('components.form.errors')
                <div class="custom-control custom-checkbox mb-3">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">Mot de passe oublié</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
