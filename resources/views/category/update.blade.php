@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="{{route('categories.update',$cat->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nameCategory">Atualizar Categoria</label>
                    <input type="text" id="nameCategory" name="nameCategory" value="{{$cat->name}}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection
