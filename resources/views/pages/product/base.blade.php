<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@section('title')Site de E-commerce @show</title>
    <link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    @section('styles')@show
</head>
<body>
@include('components.navigation')

<div class="col-12">
    <div class="container my-5">
        @section('content')
        @show
    </div>
</div>

@section('javascript')
@show


<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/product.js') }}"></script>
<script type="text/javascript" src="{{asset('js/addons/rating.js')}}"></script>
</body>
</html>
