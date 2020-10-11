<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @section('styles')@show
</head>
<body>
@include('components.navigation')
@if(\Illuminate\Support\Facades\Auth::user()->roles == 'admin')
    <div class="col-12">
        <div class="container my-5">
            @section('content')
            @show
        </div>
    </div>
@section('javascript')
@show
@else
    @include('admin.unauthorize')
@endif

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
