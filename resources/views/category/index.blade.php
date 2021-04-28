@extends('layout.app')
@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            <table class="table table-bordered table-hover" id="tbCategories">
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"
                        onclick="newCategory()">
                    Adicionar
                </button>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" id="dlgCategory" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="form-horizontal" id="formCategory">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="titleModal"></h5>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idCategory" value="" class="form-control">
                                    <div class="form-group">
                                        <label for="nameCategory" class="control-label">Nome da Categoria</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nameCategory"
                                                   id="nameCategory"
                                                   placeholder="Nome da Categoria">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
        });
        getTr = (category) => {
            line = "<tr>" +
                "<td>" + category.id + "</td>" +
                "<td>" + category.name + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onClick="edit(' + category.id + ')">Editar</button>' +
                '<button class="btn btn-sm btn-danger" onClick="remove(' + category.id + ')">Apagar</button>'
                + "</td>" +
                "</tr>";
            return line;
        };

        showTable = () => {
            $.getJSON('api/categories', (data) => {
                data.forEach((element) => {
                    $('#tbCategories>tbody').append(getTr(element));
                });
            });
        }

        $(() => {
            showTable()
        })

        newCategory = () => {
            $('#titleModal').empty();
            $('#titleModal').append('Cadastro de categorias');
            $('#idCategory').val('')
            $('#nameCategory').val('')
        };

        edit = (id) => {
            $('#titleModal').empty();
            $('#titleModal').append('Atualizar categoria');
            $.getJSON('api/categories/' + id, (data) => {
                $('#idCategory').val(data.id)
                $('#nameCategory').val(data.name)
            });
        };
        getCategory = () => {
            cat = {
                id: $('#idCategory').val(),
                name: $('#nameCategory').val()
            };
            return cat;
        };
        updateCategory = () => {
            cat = getCategory();
            $.ajax({
                type: 'PUT',
                url: 'api/products/' + cat.id,
                data: cat,
                context: this,
                success: (data) => {
                    prod = JSON.parse(data);
                    line = $('#tbCategories>tbody>tr').filter((i, element) => {
                        return element.cells[0].textContent == prod.id;
                    });
                    if (line) {
                        line[0].cells[0].textContent = prod.id;
                        line[0].cells[1].textContent = prod.name
                    }
                },
                error: (message) => {
                    console.log(message)
                }
            });
        };

        remove = (id) => {
            $.ajax({
                type: "DELETE",
                url: "api/categories/" + id,
                context: this,
                success: (data) => {
                    category = JSON.parse(data);
                    line = $('#tbCategories>tbody').filter((i, element) => {
                        return element.cells[0].textContent == category.id;
                    });
                    return line.remove();
                },
                error: (message) => {
                    console.log(message)
                }
            });
        };

        createCategory = () => {
            cat = getCategory();
            $.post('api/categories',cat, (data) => {
                category = JSON.parse(data)
                $('#tbCategories>tbody').append(getTr(category));
            });
        };
        $('#formCategory').submit((event) => {
            event.preventDefault();
            return $('#idCategory').val() == "" ? createCategory() : updateCategory();
            $('#dlgCategory').modal('hide');
        })

    </script>
@endsection
