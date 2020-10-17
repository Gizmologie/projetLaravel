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
            <div class="form-group">
                <label>is_active (0 = No & 1 = Yes)</label>
                <input type="text" class="form-control" name="is_active"  required>
            </div>
            <div class="form-group">
                <label>roles</label>
                <input type="text" class="form-control" name="roles" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            @include('components.form.errors')
        </form>
    </div>
@endsection
