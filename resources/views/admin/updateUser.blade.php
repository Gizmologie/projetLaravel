@extends('admin.base')

@section('content')

    <h1>Details de {{$user->name}}</h1>

    <form method="post" action="{{ route('updateUser', $user->id) }}">
        @csrf
        <div class="form-group">
            <label>Nom de l'utilisateur</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="text" class="form-control" name="email" value="{{$user->email}}" required>
        </div>
        <div class="form-group">
            <label>roles</label>
            <input type="text" class="form-control" name="roles" value="{{$user->roles}}">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        @include('components.form.errors')
    </form>

@endsection
