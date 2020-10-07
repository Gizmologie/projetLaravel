<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

@section('styles')@show
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="container my-5">
                @section('content')
                @show
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    @section('javascript')
    @show
</body>
</html>
