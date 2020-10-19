@extends('admin.base')

@section('content')

    <div class="offset-md-3 col-md-6">
        <h1>Création d'un utilisateur</h1>

        <form method="post" action="{{route('storeUser')}}">
            @csrf
            <div class="form-group">
                <label>Nom de l'utilisateur</label>
                <input type="text" class="form-control" name="name"  required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="password"  required>
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="text" class="form-control" name="email"  required>
            </div>
            <select class="form-control" name="roles">
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>

            <button type="submit" class="btn btn-primary">Créer</button>
            @include('components.form.errors')
        </form>
    </div>
@endsection
