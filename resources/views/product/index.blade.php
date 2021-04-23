@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Produtos</h5>
            @if(count($prod)>0)
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prod as $p)
                        <tr>
                            <td>{{$p->id}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->price}}</td>
                            <td>{{$p->stock}}</td>
                            @foreach($cats as $cat)
                                @if($cat->id == $p->category_id)
                                <td>{{$cat->name}}</td>
                                @endif
                            @endforeach


                            <td>

                                <a href="{{route('products.edit',$p->id)}}" class="btn btn-primary btn-sm">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">Editar</a>
                                <form action="{{route('products.destroy',$p->id)}}" class="d-inline" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{route('products.create')}}" class="btn-botton btn btn-primary btn-sm">Novo</a>
        </div>
    </div>

@endsection
