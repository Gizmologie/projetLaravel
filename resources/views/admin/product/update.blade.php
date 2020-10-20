@extends('admin.base')

@section('content')

    <h1>Details de {{$product->name}}</h1>
    <br><br>
    <form method="post" action="{{ route('updateProduct', $product->id) }}">
        @csrf
        <div class="form-group">
            <label>Nom du produit</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control" name="slug" value="{{$product->slug}}" required>
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" class="form-control" name="price" value="{{$product->price}}"required>
        </div>
        <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" name="stock_quantity" value="{{$product->stock_quantity}}" required>
        </div>
        <div class="form-group">
            <label>Promotion</label>
            <input type="number" class="form-control" name="promotion" value="{{$product->promotion}}">
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" accept="image/png" class="form-control">
        </div>
        <div class="form-group">
            <label>Description Technique</label>
            <textarea type="input" rows="5" class="form-control" name="description" required>
                {{$product->description}}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
        @include('components.form.errors')
    </form>

@endsection
