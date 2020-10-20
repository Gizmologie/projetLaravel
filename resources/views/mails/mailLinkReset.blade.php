@extends('mails.base')

@section('title')
    Reinitialisation du mot de passe
@endsection

@section('content')
    <p>Bonjour {{ $user->name }}<p>
    <p>Code de validation e-commerce</p>
    <p>Vous avez reçu ce code de vérification car vous avez souhaitez récupérer l'accès à votre compte e-commerce.</p>
        <div class="form-group">
            <label><b>Lien :</b></label>
            <br>
            <a class="form-control">
                <a href="{{ $link }}">ici</a>
            </a>
        </div>
    <p>Si vous avez reçu le code sans en faire la demande, vous pouvez l'ignorer en toute sécurité</p>
@endsection
