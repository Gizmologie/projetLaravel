@extends('layouts.base')

@section('content')
    <div class="col-sm-4 order-sm-2 mt-0">
        <div class="card">
            <div class="offset-sm-4 col-sm-4">
                <span><b>PANIER</b></span>
            </div>
            <div class="col-sm-10 my-2">
                Total :<tr>100€</tr>
            </div>
            <br>
        </div>
    </div>
{{--  début de la carte (mettre le foreach avant)  --}}
    <div class="col-sm-7 my-1">
        <div class="card">
            <div class="card-body p-1">
                <div class="row">
                    <div class="offset-sm-3 col-sm-3 d-flex order-sm-3">

                        <div class="form-group">
                            <input type="number" value="1" class="form-control">
                         </div>

                        <div class="ml-auto">
                            <a type="submit" href="" class="btn btn-danger btn-sm">
                                <span class="icon icon-cross"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="#"><img class="card-img-top" src="" alt="Image not found"></a>
                    </div>
                    <div class="col-sm-3">
                        <p class="card-title">Nom du produit</p>
                        <p>Prix</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--  Fin de la carte (endforeach apres)  --}}

{{--Carte 2 --}}
    <div class="col-sm-7 my-1">
        <div class="card">
            <div class="card-body p-1">
                <div class="row">
                    <div class="offset-sm-3 col-sm-3 d-flex order-sm-3">

                        <div class="form-group">
                            <input type="number" value="1" class="form-control">
                        </div>

                        <div class="ml-auto">
                            <a type="submit" href="" class="btn btn-danger btn-sm">
                                <span class="icon icon-cross"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="#"><img class="card-img-top" src="" alt="Image not found"></a>
                    </div>
                    <div class="col-sm-3">
                        <p class="card-title">Nom du produit</p>
                        <p>Prix</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--fin de carte 2--}}

@endsection
