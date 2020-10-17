<link rel="stylesheet" href="{{ asset('css/commentBox.css') }}">

@if(\Illuminate\Support\Facades\Auth::check())


<form method="post" action="{{route('storeComment', ['product_id' => $product->id])}}">
    @csrf
    <div class="form-group row mx-0">
        <p class="col-12">Laisse un commentaire sur ce produit</p>

        <input type="text" class="form-control comment col-sm-6" name="title" placeholder="titre" required>
        <input type="number" class="form-control comment offset-sm-1 col-sm-2" placeholder="note" name="rate" required>
        <textarea type="text" class="form-control col-sm-12 mt-4" name="content" placeholder="commentaire" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Commenter</button>
    @include('components.form.errors')
</form>

@endif
