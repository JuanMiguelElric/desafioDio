@extends('adminlte::page')
@section('title','Questões')
@section('content_header')
<!-- <h1>Perguntas</h1> -->
@endsection

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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="perguntas">

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </x-adminlte-card>
    <x-adminlte-modal id="modalMin" title="exclusão">
        <div>Tem certeza que quer excluir?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel"/>
            <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
        </x-slot>
    </x-adminlte-modal>
</div>





@endsection

@push('js')
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
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
        console.log(valorSelecionado);
        $.ajax({
            type: 'GET',
            url: '/perguntasJson/' + valorSelecionado,
            success: function(response) {
                // Lógica de sucesso
                // Atualize a página ou faça outras ações necessárias
                $('#perguntas').empty()
                $.each(response.perguntas, function(index, {
                    id,
                    titulo,
                    created_at
                }) {
                    $('#perguntas').append(
                        renderizaAlternativas(index, id, titulo, created_at)
                    )
                })



            },
            error: function(xhr, status, error) {
                // Lógica de erro
                // console.error(xhr.responseText);
                toastr.warning(xhr.responseJSON.error)
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
            }
        });
    });

    function renderizaAlternativas(index, id, titulo, created_at) {
        let tr = `<tr data-widget="expandable-table" aria-expanded="false">
            <td>${index+1}</td>
            <td>${titulo}</td>
            <td>${created_at}</td>
            <td>${btn(id)}</td>
        </tr>`

        return tr;
    }

    function btn(id) {
        let btnEdit = `<a href="/perguntas/${id}/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>`;

        let btnDelete = `<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="${id}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>`;

        //let btnDetails = `<a href="{{route('perguntas.show', '')}}/${id}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
          //                  <i class="fa fa-lg fa-fw fa-eye"></i>
            //            </a>`;

        return `<nobr>${btnEdit + btnDelete }</nobr>`
    }


    //delete method

    $(document).on('click', '.excluir-dado', function() {

        let dadoId = $(this).data('dado-id');
        let button = $(this);
        console.log(dadoId, button)
        $('#modalMin').modal('show');
        $('#cancel').click(function(){
            $('#modalMin').modal('hide')
            return
        })
        $('#confirmation').off('click').on('click', function() {
            $.ajax({
                type: 'DELETE',
                url: '/perguntas/' + dadoId,
                data: {
                    '_token': '{{csrf_token()}}'
                },
                success: function(response) {
                    $('#modalMin').modal('hide');
                    button.parent().parent().parent().remove()
                    console.log(response)
                    $(document).add(function() {
                        Toast.fire({
                            icon: 'success',
                            title: response.success,
                        })
                    });
                    return
                },
                error: function(xhr, status, error) {
                    $(document).add(function() {
                        Toast.fire({
                            icon: 'error',
                            title: error,
                        })
                    });
                    return

                    console.error(xhr.responseText);
                }
            })
        })
    })
</script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)