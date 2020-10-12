<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
    Commenter
</button>

<!-- Modal -->
<form method="post" action="{{route('storeComment', ['product_id' => $product->id])}}">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--  Ajouter un commentaire  --}}

                        <div class="form-group">
                            <input type="text" class="form-control col-sm-6" name="title" placeholder="titre" required>
                            <textarea type="text" class="form-control col-sm-10" name="content" placeholder="commentaire" required></textarea>
                            <input type="number" class="form-control col-sm-2" placeholder="note" name="rate" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Commenter</button>
                    @include('components.errors')
                </div>
            </div>
        </div>
    </div>
</form>
