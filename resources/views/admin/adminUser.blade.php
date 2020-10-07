@extends('admin.base')

@section('content')

    <h5> Administration utilisateur</h5>
    <div class="col-md-6">
        <a href="{{route('createUser')}}" class="btn btn-primary">Nouvel utilisateur</a>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Email</div>
        <div class="col-md-2">Roles</div>
        <div class="col-md-2">Creation</div>
        <div class="col-md-3">Actions</div>
        <br>
        @foreach($users as $user)
            <br><br>
            <div class="col-md-2">{{ $user->name }}</div>
            <div class="col-md-2">{{ $user->email }}</div>
            <div class="col-md-2">{{ $user->roles }}</div>
            <div class="col-md-2">{{$user->created_at->format('d/m/Y à H:m')}}</div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('detailsUser', ['id' => $user->id])}}" class="btn btn-warning">Modifier</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{route('deleteUser', ['id' => $user->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Banir</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




@endsection
