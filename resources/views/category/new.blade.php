@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="{{route('categories.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameCategory">Nova Categoria</label>
                    <input type="text" id="nameCategory" name="nameCategory" placeholder="Nome da Categoria">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection
