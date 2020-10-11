<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">


    @section('styles')@show
</head>
<body>
@include('components.navigation')

    <div class="col-12 col-md-9">
        <div class="container my-5">
            @section('content')
            @show
        </div>
    </div>

@section('javascript')
@show


<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
