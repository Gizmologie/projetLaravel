@extends('admin.base')

@section('content')

    <h1>Création d'un produit</h1>

    <form method="post" action="{{route('storeProduct')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nom du produit</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" class="form-control" name="base_price" required>
        </div>
        <div class="form-group">
            <label>Quantité</label>
            <input type="number" class="form-control" name="stock_quantity"  required>
        </div>
        <div class="form-group">
            <label>Promotion</label>
            <input type="number" class="form-control" name="promotion">
        </div>
        <div class="form-group">
            <label>Disponible le :</label>
            <input type="date" class="form-control" name="available_at">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea type="input" rows="5" class="form-control" name="description" required>
            </textarea>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" accept="image/png" required class="form-control">
        </div>
        <label>Catégorie</label>
        <select name="category_id" class="custom-select">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Créer</button>
        @include('components.form.errors')
    </form>

@endsection
