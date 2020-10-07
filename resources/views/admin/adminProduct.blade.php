@extends('admin.base')

@section('content')

    <h5> Administration Produit</h5>
    <br><br>
    <div class="row">
        <div class="col-md-3">Name</div>
        <div class="col-md-3">Price</div>
        <div class="col-md-3">Stock quantity</div>
        <div class="col-md-3">Actions</div>
        <br><br>
        @foreach($products as $product)
            <br><br>
            <div class="col-md-3">{{ $product->name }}</div>
            <div class="col-md-3">{{ $product->slug }}</div>
            <div class="col-md-3">{{ $product->stock_quantity }}</div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('detailsProduct', ['id' => $product->id])}}" class="btn btn-warning">Modifier</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{route('deleteProduct', ['id' => $product->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>


    <style>
        div {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 1000px;
        }
    </style>


@endsection
