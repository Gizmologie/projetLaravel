@extends('layouts.base')

@section('content')

    <div class="row mt-5">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{$user->name}}</h4>
                            <a href="{{route('updatePassword')}}" class="btn btn-outline-warning">Modifier mot de passe</a>
                            {{--                        <button class="btn btn-outline-danger">Supprimer</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nom</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->name}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->email}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Roles</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">{{$user->roles}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Date de création</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->created_at->format('d/m/Y H:m')}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Dernière mise à jour</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->updated_at->format('d/m/Y H:m')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 pt-5">
        @foreach($user->getOrders() as $order)
            <div class="col-12 col-md-4 mb-3">
                <div class="card">
                    <div class="card-header bg-transparent border-bottom-0">
                        <span class="card-badge bg-primary">
                            <i class="fas fa-truck fa-2x mt-2"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class=" text-uppercase mb-0">Commande n°{{ $order->id }}</h4>
                            <small class="text-success">{{ $order->getDeliveryStateName() }}</small>
                        </div>
                        <div class="row pt-4">
                            <div class="col-6 text-left">
                                <p>
                                    <strong>{{ $order->getNbObjects() }}</strong> produit(s)
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <p>
                                    <strong>{{ $order->getTotalWithDelivery() }}</strong> €
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">
                        <a class="btn btn-primary" href="{{ route('userOrderShow', ['id' => $order->id]) }}">Consulter</a>
                    </p>
                 </div>
            </div>
        @endforeach
    </div>

@endsection
