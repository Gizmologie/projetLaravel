@extends('admin.base')

@section('content')

    {{-- template : https://www.bootdey.com/snippets/view/profile-with-data-and-skills# --}}

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{$user->name}}</h4>
                                <a href="{{route('updatePassword', ['id' => $user->id])}}" class="btn btn-outline-warning">Modifier password</a>
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">

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
                                <h6 class="mb-0">Status compte</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                @if($user->is_active == 0)
                                    Inactif
                                @else
                                    Actif
                                @endif
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
    </div>
</div>


@endsection
