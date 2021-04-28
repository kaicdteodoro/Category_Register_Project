@extends('layout.app')
@section('title','Produtos')
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
                    <th class="text-center">#</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer container-sm">
            <div class="row">
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"
                            onclick="newProduct()">Adicionar
                    </button>
                </div>
                <div class="col-sm">
                    <p class="text-danger text-sm-left">É necessário ao menos uma categoria cadastrada</p>
                </div>

            </div>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" id="dlgProduct">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="form-horizontal" id="formProduct">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titleModal"></h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="idProduct" value="" class="form-control">
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
            $('#idProduct').val('');
            $('#stockProduct').val('');
            $('#priceProduct').val('');
            $('#categoryProduct').val('');
        }

        opList = () => {
            $.getJSON("api/getCategory", (data) => {
                data.forEach((element) => {
                    $('#categoryProduct').append('<option value="' + element.id + '">' + element.name + '</option>');
                });
            });
        }
        getCategory = (id) => {
            return category = $('#categoryProduct>option').filter((i, element) => {
                return element.value == id;
            });
        }

        makeLine = (obj) => {
            category = getCategory(obj.category_id);

            var line = '<tr>' +
                '<td>' + obj.id + '</td>' +
                '<td>' + obj.name + '</td>' +
                '<td>' + obj.price + '</td>' +
                '<td>' + obj.stock + '</td>' +
                '<td>' + category[0].textContent + '</td>' +
                '<td class="text-center">' +
                '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onClick="edit(' + obj.id + ')">Editar</button>' +
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
            });
        }

        remove = (id) => {
            $.ajax({
                type: "DELETE",
                url: "api/products/" + id,
                context: this,
                success: (message) => {
//mexi aqui, se der erro foi isso, antes tava atribuindo o seletor do jquery pra variável rm
                    elements = $("#tbProducts>tbody>tr").filter((i, element) => {
                        return element.cells[0].textContent == id;
                    });
                    return elements.remove();
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
                    category = getCategory(prod.category_id);
                    if (line) {
                        line[0].cells[1].textContent = prod.name;
                        line[0].cells[2].textContent = prod.price;
                        line[0].cells[3].textContent = prod.stock;
                        line[0].cells[4].textContent = category[0].textContent;
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
                product = JSON.parse(data);
                $('#tbProducts>tbody').append(makeLine(product));
            });
        }

        $('#formProduct').submit((event) => {
            event.preventDefault();
            $('#idProduct').val() == '' ? createProduct() : updateProduct();
            $('#dlgProduct').modal('hide')
        });

        $(() => {
            opList();
            tdList();
        })
    </script>
@endsection

