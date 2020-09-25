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
        <div class="col-3 d-none d-md-block">
            <h1 class="my-4">Shop Name</h1>
            <div class="list-group">
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>
        <div class="col-12 col-md-9">
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
