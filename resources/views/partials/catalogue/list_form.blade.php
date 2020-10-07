<form action="{{ route('search') }}">
    <div class="accordion" id="filters">
        <div class="card">
            <div class="card-header" id="headingCategories">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                        Catégories de produit
                    </button>
                </h2>
            </div>
            <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#filters">
                <div class="card-body">
                    @foreach($categories as $category)
                        <fieldset style="min-width: 100px">
                            <input class="input-search" name="categories[]" type="checkbox" value="{{ $category->id }}" @if(in_array($category->id, $selected['categories']))checked="checked"@endif />
                            <label for="">{{ $category->name }}</label>
                        </fieldset>
                    @endforeach
                </div>
            </div>

            @if($selected['price'])
                <div class="card-header" id="headingPrice">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                            Prix
                        </button>
                    </h2>
                </div>
                <div id="collapsePrice" class="collapse" aria-labelledby="headingPrice" data-parent="#filters">
                    <div class="card-body">
                        <label for="">Prix min : </label>
                        <input class="form-control" name="price[min]" type="number" value="{{ $selected['price']['min'] }}" /><br>
                        <label for="">Prix max : </label>
                        <input class="form-control" name="price[max]" type="number" value="{{ $selected['price']['max'] }}" />
                    </div>
                </div>
            @endif
            @if($selected['promotion'])
                <div class="card-header" id="headingPromotion">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapsePromotion" aria-expanded="true" aria-controls="collapsePromotion">
                            Promotion
                        </button>
                    </h2>
                </div>
                <div id="collapsePromotion" class="collapse" aria-labelledby="headingPromotion" data-parent="#filters">
                    <div class="card-body">
                        <label for="">Promotion min : </label>
                        <input class="form-control" name="promotion[min]" type="number" value="{{ $selected['promotion']['min'] }}" /><br>
                        <label for="">Promotion max : </label>
                        <input class="form-control" name="promotion[max]" type="number" value="{{ $selected['promotion']['max'] }}" />
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group mt-3">
        <button class="btn btn-primary" type="submit">Rechercher</button>
    </div>
</form>
