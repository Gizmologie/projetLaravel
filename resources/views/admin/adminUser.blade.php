@extends('admin.base')

@section('content')

    <h5> Administration utilisateur</h5>

    <div class="row">
        @foreach($users as $user)
            <div class="col-md-4">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">{{ $user->email }}</p>
                                <p class="card-text">{{ $user->roles }}</p>
                                <p>Création du compte le {{$user->created_at->format('d/m/Y à H:m')}}</p>

                                {{-- Boutton --}}
                                <a href="{{route('detailsUser', ['id' => $user->id])}}" class="btn btn-warning">Modifier</a>

                                <form action="{{route('deleteUser', ['id' => $user->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Banir</button>
                                </form>

                                {{-- Fin Boutton --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




@endsection
