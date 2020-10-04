<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

@section('styles')@show
</head>
<body>
    @include('components.navigation')
    @include('components.category')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    @section('javascript')
    @show
</body>
</html>
