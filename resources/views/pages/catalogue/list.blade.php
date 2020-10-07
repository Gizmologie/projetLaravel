@extends('layouts.base')

{{--@section('title')--}}
{{--@endsection--}}

@section('content')
    <div class="row mt-5">
        <div class="col-md-3 d-none d-md-block">
            <form action="{{ route('search') }}">
                    <select name="categories[]" class="js-select2" id="search_category" multiple="multiple">
                    @foreach($categories as $category)
                            @php var_dump(in_array($category->id, $selected['categories']))@endphp
                            <option value="{{ $category->id }}" @if(in_array($category->id, $selected['categories']))selected="selected"@endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-9">
            @foreach($products as $row)
               <div class="row mb-5">
                    <div class="col-12">
                        <div class="card-deck">
                            @foreach($row as $product)
                                @include('components.product.card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
               </div>
            @endforeach
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@show
