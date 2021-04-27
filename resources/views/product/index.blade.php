@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title"> Cadastro Produtos</h5>
            <table class="table table-bordered table-hover" id="tbProducts">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Categoria</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn-botton btn btn-primary btn-sm" onclick="newProduct()">Novo</button>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="dlgProducts">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduct">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModal">aaa</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idProduct" class="form-control">
                        <div class="form-group">
                            <label for="nameProduct" class="control-label">Nome do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nameProduct" id="nameProduct"
                                       placeholder="Nome do produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="priceProduct" class="control-label">Preço do Produto</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="priceProduct" id="priceProduct"
                                       placeholder="Preço do produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stockProduct" class="control-label">Estoque do Produto</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="stockProduct" id="stockProduct"
                                       placeholder="Estoque do produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoryProduct" class="control-label">Categoria do Produto</label>
                            <div class="input-group">
                                <select class="form-control" name="catProduct" id="categoryProduct"></select>
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
@endsection
@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        newProduct = () => {
            $('#titleModal').empty();
            $('#titleModal').append('Cadastro de Produtos');
            $('#nameProduct').val('');
            $('#stockProduct').val('');
            $('#priceProduct').val('');
            $('#categoryProduct').val('');
            $('#dlgProducts').modal('show');
        }

        opList = () => {
            $.getJSON("{{route('categories.indexJson')}}", (data) => {
                data.forEach((obj) => {
                    $('#categoryProduct').append('<option value="' + obj.id + '">' + obj.name + '</option>');
                });
            })
        }

        makeLine = (obj) => {
            var line = '<tr>' +
                '<td>' + obj.id + '</td>' +
                '<td>' + obj.name + '</td>' +
                '<td>' + obj.price + '</td>' +
                '<td>' + obj.stock + '</td>' +
                '<td>' + obj.category_id + '</td>' +
                '<td>' +
                '<button class="btn btn-sm btn-primary" onClick="edit(' + obj.id + ')">Editar</button>' +
                '<button class="btn btn-sm btn-danger" onClick="remove(' + obj.id + ')">Apagar</button>'
                + '</td>'
                + '</tr>';
            return line;

        }

        tdList = () => {
            $.getJSON("{{route('products.index')}}", (data) => {
                data.forEach((obj) => {
                    $('#tbProducts>tbody').append(makeLine(obj));
                });
            })
        }

        edit = (id) => {
            $.getJSON("api/products/" + id, (data) => {
                $('#titleModal').empty();
                $('#titleModal').append('Atualizar Produto');
                $('#idProduct').val(data.id);
                $('#nameProduct').val(data.name);
                $('#stockProduct').val(data.stock);
                $('#priceProduct').val(data.price);
                $('#categoryProduct').val(data.category_id);
                $('#dlgProducts').modal('show');
            });
        }

        remove = (id) => {
            $.ajax({
                type: "DELETE",
                url: "api/products/" + id,
                context: this,
                success: (message) => {
                    elements = $("#tbProducts>tbody>tr");
                    rm = elements.filter((i, element) => {
                        return element.cells[0].textContent == id;
                    });
                    return rm.remove();
                    console.log(message);
                },
                error: (error) => {
                    console.log(error);
                }
            });
        }

        updateProduct = () => {
            prod = {
                id: $('#idProduct').val(),
                name: $('#nameProduct').val(),
                stock: $('#stockProduct').val(),
                price: $('#priceProduct').val(),
                category_id: $('#categoryProduct').val()
            }
            $.ajax({
                type: "PUT",
                url: "api/products/" + prod.id,
                data: prod,
                context: this,
                success: (data) => {
                    prod = JSON.parse(data);
                    lines = $('#tbProducts>tbody>tr');
                    line = lines.filter((i, element) => {
                        return element.cells[0].textContent == prod.id;
                    });
                    if(line){
                        line[0].cells[1].textContent = prod.name;
                        line[0].cells[2].textContent = prod.price;
                        line[0].cells[3].textContent = prod.stock;
                        line[0].cells[4].textContent = prod.category_id;
                    }
                },
                error: (message) => {
                    console.log(message.responseText);
                }
            })
        }

        createProduct = () => {
            prod = {
                name: $('#nameProduct').val(),
                stock: $('#stockProduct').val(),
                price: $('#priceProduct').val(),
                category_id: $('#categoryProduct').val()
            }
            $.post("{{route('products.store')}}", prod, (data) => {
                $('#tbProducts>tbody').append(makeLine(data));
            });
        }

        $('#formProduct').submit((event) => {
            event.preventDefault();
            $('#idProduct') ? updateProduct() : createProduct();
            $('#dlgProducts').modal('hide')
        });

        $(() => {
            tdList();
            opList();
        })
    </script>
@endsection

