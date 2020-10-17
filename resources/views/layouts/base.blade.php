<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('styles')@show
</head>
<body>
    @include('components.navigation')
    <div class="container">
        @section('content')
        @show
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    @section('javascript')
    @show
</body>
</html>
