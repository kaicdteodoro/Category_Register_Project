@extends('layout.app')
@section('body')
   <div class="jumbotron bg-light border border-secondary">
       <div class="row">
           <div class="card-deck">
               <div class="card border border-primary">
                   <div class="card-body">
                       <h5 class="card-title">Cadastro de Produtos</h5>
                       <p class="card-text">Aqui você cadastra todos os seus produtos. Só não esqueça de cadastrar
                           préviamente as categorias</p>
                       <a href="{{route('products.create')}}" class="btn btn-primary">Cadastrar</a></div>
               </div>
               <div class="card border border-primary">
                   <div class="card-body">
                       <h5 class="card-title">Cadastro de Categorias</h5>
                       <p class="card-text">Cadastre as categorias dos seus produtos</p>
                       <a href="{{route('categories.create')}}" class="btn btn-primary">Cadastrar</a></div>
               </div>
           </div>
       </div>

   </div>
    @endsection
