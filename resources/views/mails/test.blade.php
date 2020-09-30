@extends('mails.base')

@section('title')
    C'est un mail de test
@endsection

@section('content')
    {{ $param }}
@endsection
