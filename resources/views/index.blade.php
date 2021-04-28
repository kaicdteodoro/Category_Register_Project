@extends('layout.app')
@section('title','Home')
@section('body')
   <div class="jumbotron bg-light border border-secondary">
       <div class="row">
           <div class="card-deck">
               <div class="card border border-primary">
                   <div class="card-body">
                       <h5 class="card-title">Produtos</h5>
                       <p class="card-text">Aqui você encontra todos os seus produtos. Só não esqueça de cadastrar
                           préviamente as categorias</p>
                       <a href="{{route('products.home')}}" class="btn btn-primary">Visualizar</a></div>
               </div>
               <div class="card border border-primary">
                   <div class="card-body">
                       <h5 class="card-title">Categorias</h5>
                       <p class="card-text">Veja as categorias dos seus produtos</p>
                       <a href="{{route('categories.home')}}" class="btn btn-primary">Cadastrar</a></div>
               </div>
           </div>
       </div>

   </div>
    @endsection
