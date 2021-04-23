@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="{{route('products.update',$prod->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="nameProduct" value="{{$prod->name}}">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="priceProduct" value="{{$prod->price}}">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="stockProduct" value="{{$prod->stock}}">
                    </div>
                    <select class=" custom-select mr-sm-2 col" name="catProduct" id="inlineFormCustomSelect">
                        @foreach($cats as $cat)
                            @if($cat->id == $prod->category_id)
                                <option selected value="{{$cat->id}}">{{$cat->name}}</option>
                             @else
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                             @endif
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
