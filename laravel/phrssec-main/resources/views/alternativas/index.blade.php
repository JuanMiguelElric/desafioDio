@extends('adminlte::page')
@section('title','Alternativas')
@section('content_header')
<!-- <h1>Perguntas e Alternativas</h1> -->
@endsection
@push('css')
<style type="text/css">
    .editar:hover {
        background: #ced4da;
    }
</style>
@endpush
@section('content')
<div class="container">

    <x-adminlte-card title="Avaliação" theme="dark" theme-mode="outline" class="elevation-3" body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light" collapsible>
        <form id="form">
            @csrf
            <!-- /.card-body -->
            <div class="card-body">
                <input type="hidden" name="json" value="false">
                <div class="form-group">
                    <x-adminlte-select id="avaliacoes" name="avaliacao" label="Avaliações">
                        <option value="" selected>Selecionar...</option>
                        @foreach ($avaliacoes as $avaliacao)
                        <option value="{{$avaliacao->id}}">{{$avaliacao->titulo}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
            </div>
            <div class="card-footer">
                <!-- <x-adminlte-button type="submit" label="Gerar Avaliação" class="btn btn-primary" theme="primary" /> -->
            </div>
        </form>
    </x-adminlte-card>
    <x-adminlte-card title="Perguntas" theme="dark" theme-mode="outline" class="elevation-3" body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light" collapsible>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Perguntas</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Perguntas</th>
                                <th>Date</th>
                                <th>quantidade</th>
                            </tr>
                        </thead>
                        <tbody id="perguntas">

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </x-adminlte-card>
</div>




@endsection

@push('js')
<script>
    $("#avaliacoes").change(function() {
        var valorSelecionado = $(this).val();
        if (valorSelecionado == "") {
            $('#perguntas').empty()
            $('#perguntas').append(
                `<tr>
                    <td colspan="5">
                    <p class="text-center">
                        SEM DADOS..    
                    </p>
                    </td>
                </tr>`
            )
            return
        }
        // console.log(valorSelecionado);
        $.ajax({
            type: 'GET',
            url: '/perguntaComAlternativa/' + valorSelecionado,
            success: function(response) {
                // Lógica de sucesso
                // Atualize a página ou faça outras ações necessárias
                $('#perguntas').empty()
                $.each(response.perguntas, function(index, {
                    id,
                    titulo,
                    created_at,
                    alternativas
                }) {
                    perguntaId = id;
                    $('#perguntas').append(
                        renderizaAlternativas(id, titulo, created_at, alternativas)
                    )
                })



            },
            error: function(xhr, status, error) {
                // Lógica de erro
                // console.error(xhr.responseText);
                toastr.warning(xhr.responseJSON.error)
                $('#perguntas').empty()
                $('#perguntas').append(
                    ` < option value = "#" > $ {
                                        xhr.responseJSON.perguntas
                                    } < /option>`
                )
            }
        });
    });

    function renderizaAlternativas(id, titulo, created_at, alternativas) {
        let tr = `<tr data-widget="expandable-table" aria-expanded="false">
            <td>${id}</td>
            <td>${titulo}</td>
            <td>${created_at}</td>
            <td>${alternativas.length}</td>
        </tr>
        <tr class="expandable-body">
            <td colspan="4">`
        $.each(alternativas, function(index, {
            id,
            opcao,
            verdadeiro
        }) {

            tr += `<div style="display:none;" class=" ${verdadeiro ? "border border-success rounded": "border border-secondary rounded"}">
                    <div class="d-flex justify-content-between ">
                        <div class="inputs " >
                            <input type="hidden"  value="${opcao}" id="input-${id}" data-dado-id="${id}"/>
                            <div class="irmao editar rounded p-2">${opcao}</div>
                        </div>
                            <div>
                                <input type="checkbox" class="checks" value="${verdadeiro ? "1": "0"}" id="check-${id}" data-dado-id="${id}" ${verdadeiro ? "checked": ""}/>
                                ${btn(id)}
                            </div>   
                    </div>
                </div>`;
        })
        tr += `</td></tr>`;
        return tr;
    }

    function btn(id) {
        let btnEdit = `<a href="/alternativas/${id}/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>`;

        let btnDelete = `<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="${id}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>`;


        return `<nobr>${btnEdit + btnDelete}</nobr>`
    }


    //toast
    $(document).on('click', '.checks', function() {
        let dadoId = $(this).data('dado-id');
        if ($(this).val() == '1') {
            $(this).parent().parent().parent().removeClass('border border-success rounded')
            $(this).parent().parent().parent().addClass('border border-secondary rounded')
            $(this).val('0');
        } else {
            $(this).parent().parent().parent().removeClass('border border-secondary rounded')
            $(this).parent().parent().parent().addClass('border border-success rounded')
            $(this).val('1')
        }
        // console.log(dadoId, $(this).val())
        $.ajax({
            type: 'PUT',
            url: "/alternativas/" + dadoId,
            data: {
                '_token': "{{csrf_token()}}",
                'verdadeiro': $(this).val(),
                'json': '1',
                'opcao': $(this).parent().parent().find('.irmao').text()
            },
            success: function(response) {
                // console.log(response)
                toastr.success(response.message)
            },
            error: function(xhr, status, error) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.warning(value)
                })
            }

        })

        return

    })

    //delete method
    $(document).on('click', '.excluir-dado', function() {
        let dadoId = $(this).data('dado-id');
        // console.log(dadoId, "{{csrf_token()}}")
        let element = $(this);
        if (!confirm('excluir alternativa ?')) return;
        $.ajax({
            type: 'DELETE',
            url: "/alternativas/" + dadoId,
            data: {
                '_token': "{{csrf_token()}}"
            },
            success: function(response) {
                // console.log(response)
                element.parent().parent().parent().parent().remove();
                toastr.success(response.message)
            },
            error: function(xhr, status, error) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.warning(value)
                })
            }

        })
        return
    })

    $(document).on('dblclick', ".inputs", function(event) {
        var div = $(this).find('div');
        var input = $(this).find('input')

        input.prop('type', input.prop('type') === 'hidden' ? 'text' : 'hidden');
        div.toggleClass('d-none');
        return;

    })
    $(document).on('keypress', 'input', function(e) {
        let dadoId = $(this).data('dado-id');
        // console.log(dadoId, "{{csrf_token()}}")
        var key = e.which;
        if (key == 13) {
            $(this).attr('type', 'hidden')
            var pai = $(this).parent();
            div = pai.find('.irmao');
            let check = pai.parent().find('#check-' + dadoId).val()
            div.removeClass('d-none');
            var newValue = $(this).val();
            div.text(newValue)
            // console.log(div)

            $.ajax({
                type: 'PUT',
                url: "/alternativas/" + dadoId,
                data: {
                    '_token': "{{csrf_token()}}",
                    'verdadeiro': check,
                    'json': '1',
                    'opcao': newValue
                },
                success: function(response) {
                    // console.log(response)
                    toastr.success(response.message)
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }

            })
            return
        }
    })
</script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)