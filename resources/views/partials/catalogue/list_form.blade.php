<form action="{{ route('search') }}" class="filters">
    <div class="mb-3">
        <h4 class="text-secondary">Catégories</h4>
        <div class="ml-3 pt-2">
            @foreach($categories as $category)
                <fieldset style="min-width: 100px">
                    <input class="input-search" name="categories[]" type="checkbox" value="{{ $category->id }}" @if(in_array($category->id, $selected['categories']))checked="checked"@endif />
                    <label for="">{{ $category->name }}</label>
                </fieldset>
            @endforeach
        </div>
    </div>
    @if($selected['price'])
        <div class="mb-3">
            <h4 class="text-secondary">Prix</h4>
            <div class="ml-3 pt-2">
                <label for="">Prix min : </label>
                <input class="form-control" name="price[min]" type="number" value="{{ $selected['price']['min'] }}"/><br>
                <label for="">Prix max : </label>
                <input class="form-control" name="price[max]" type="number" value="{{ $selected['price']['max'] }}"/>
            </div>
        </div>
    @endif

    @if($selected['promotion'])
        <div class="mb-3">
            <h4 class="text-secondary">Promotion</h4>
            <div class="ml-3 pt-2">
                <label for="">Promotion min : </label>
                <input class="form-control" name="promotion[min]" type="number" value="{{ $selected['promotion']['min'] }}"/><br>
                <label for="">Promotion max : </label>
                <input class="form-control" name="promotion[max]" type="number" value="{{ $selected['promotion']['max'] }}"/>
            </div>
        </div>
    @endif
    <div class="form-group mt-3">
        <button class="btn btn-primary" type="submit">Rechercher</button>
    </div>
</form>
