@extends('admin.base')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h5> Administration Produit</h5>
    <a href="{{route('createProduct')}}" class="btn btn-primary">Nouveau produit</a>
</div>
<div id="page-container" class="main-admin">
    <div class="main-body-content w-100 ets-pt">

        <div class="table-responsive bg-light">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Action</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td class="d-flex">
                        <a href="{{route('detailsProduct', ['id' => $product->id])}}" class="btn btn-warning">
                            <span class="icon icon-pencil"></span>
                        </a>

                        <form action="{{route('deleteProduct', ['id' => $product->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                <span class="icon icon-cross"></span>
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
