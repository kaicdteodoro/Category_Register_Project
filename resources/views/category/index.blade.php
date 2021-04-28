@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Adicionar
                </button>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="form-horizontal" id="formCategory">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="titleModal"></h5>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idCategory" class="form-control">
                                    <div class="form-group">
                                        <label for="nameCategory" class="control-label">Nome da Categoria</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nameCategory" id="nameCategory"
                                                   placeholder="Nome da Categoria">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
