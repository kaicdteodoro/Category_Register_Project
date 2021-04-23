@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="{{route('products.store')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="nameProduct" placeholder="Nome">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="priceProduct" placeholder="Preço">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="stockProduct" placeholder="Estoque">
                    </div>
                    <select class="custom-select mr-sm-2 col" name="catProduct" id="inlineFormCustomSelect">
                        <option selected>Categoria</option>
                        @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection
