@extends('layouts.base')

@section('content')

    <h1>Details de {{$user->name}}</h1>

    <form method="post" action="{{route('passwordChange', ['id' => $user->id])}}}">
        @csrf
        <div class="form-group">
            <label>Mot de passe actuel</label>
            <input type="password" class="form-control" name="current_password" required>
        </div>
        <div class="form-group">
            <label>Nouveau mot de passe</label>
            <input type="password" class="form-control" name="new_password" required>
        </div>
        <div class="form-group">
            <label>Retaper le nouveau mot de passe</label>
            <input type="password" class="form-control" name="new_password_check" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        @include('components.errors')
    </form>

@endsection
