@extends('admin.base')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h5> Administration Utilisateur</h5>
    <a href="{{route('createUser')}}" class="btn btn-primary">Nouvel utilisateur</a>
</div>
<div id="page-container" class="main-admin">
    <div class="main-body-content w-100 ets-pt">

        <div class="table-responsive bg-light">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date création</th>
                    <th>Action</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles }}</td>
                        <td>{{$user->created_at->format('d/m/Y à H:m')}}</td>
                        <td class="d-flex">
                            <a href="{{route('detailsUser', ['id' => $user->id])}}" class="btn btn-warning">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            <form action="{{route('deleteUser', ['id' => $user->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
