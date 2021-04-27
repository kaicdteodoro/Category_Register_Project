@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            @if(count($cat)>0)
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cat as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->name}}</td>
                            <td>
                                <div class="form-inline">
                                    <a href="{{route('categories.edit',$c->id)}}"
                                       class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{route('categories.destroy',$c->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
                                    </form>
                                </div>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm">Novo</a>
        </div>
    </div>

@endsection
