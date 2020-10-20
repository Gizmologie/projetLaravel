@extends('mails.base')

@section('title')
    Votre commande a été validée
@endsection

@section('content')
    <p>
        Bonjour {{ $order->user()->name }},
    </p>
    <p>
        Votre commande n°{{ $order->id }} a été validée.
    </p>
    <p>
        Vous pouvez suivre son évolution depuis <a href="{{ route('profil') }}">votre compte</a>
    </p>

@endsection
