@extends('adminlte::page')
@section('title','Exames')
@section('content_header')
<!-- <h2 class="text-center">Avaliações</h2> -->
@endsection
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-3">
            <x-adminlte-modal id="modalPurple" title="Nova Avaliação" theme="purple" icon="fas fa-bolt" size='lg'>
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form">
                        @csrf
                        <input type="hidden" name="json" value="true">
                        <div class="card-body">
                            <div class="form-group">
                                <x-adminlte-input label="Avaliação" name="titulo" type="text" placeholder="Adequações da LGPD" />
                            </div>
                            <div class="form-group">
                                <x-adminlte-input label="Descrição" name="descricao" type="text" placeholder="sobre a avaliação" />
                            </div>
                            <div class="form-group">
                                <x-adminlte-input label="Cliente/Empresa" name="cliente" type="text" placeholder="Cliente" />
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <x-adminlte-button type="submit" label="Gerar Avaliação" class="btn btn-primary" theme="primary" data-target="#modalPurple" data-toggle="modal" />
                        </div>
                    </form>
                </div>
            </x-adminlte-modal>
            <div>
                <button class="btn btn-primary mb-2" id="refresh">Atualizar</button>
                <x-adminlte-button label="Nova Avaliação" data-toggle="modal" data-target="#modalPurple" class="bg-purple mb-2" />
            </div>
        </div>
    </div>

    @php
    $heads = [
    'ID',
    'Name',
    ['label'=>'Cliente', 'class'=> 'center'],
    'Total',
    ['label' => 'Actions', 'no-export' => true, 'width' => 10],
    ];

    $config = [
    "ajax"=>[
    'url'=>'/avaliacoesJson',
    'dataSrc'=>"avaliacoes"
    ],
    'data' => [

    ],
    'autofill'=>true,
    'order' => [[1, 'asc']],
    "columns"=>[
    ["data"=> "id"],
    ["data"=> "titulo"],
    ["data"=> "cliente"],
    ["data"=> "total"],
    ["data"=> "btns"]
    ],
    ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table2" :heads="$heads" :config="$config" striped hoverable bordered with-buttons />


</div>
<x-footer />
@endsection


@push('js')
<script>
    $(document).ready(function() {

        $('#form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '/avaliacoes',
                data: formData,
                success: function(response) {
                    // Lógica de sucesso
                    // alert(response.message);
                    // Atualize a página ou faça outras ações necessárias
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $(document).add(function() {
                        Toast.fire({
                            icon: 'success',
                            title: 'Avaliação gerada com sucesso!',
                        })
                    });
                    $('#table2').DataTable().ajax.reload();
                    // console.log(response.card)
                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $(document).add(function() {
                        Toast.fire({
                            icon: 'warning',
                            title: xhr.responseJSON.message,
                        })
                    });
                    // console.log(xhr.responseJSON);
                }
            });
        });
    });
</script>
<script>
    $(document).on('click', '.excluir-dado', function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var dadoId = $(this).data('dado-id');
        var button = $(this);
        if (confirm('Tem certeza de que deseja excluir este dado?')) {
            $.ajax({
                type: 'DELETE',
                url: '/avaliacoes/' + dadoId,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Lógica de sucesso

                    $(document).add(function() {
                        Toast.fire({
                            icon: 'warning',
                            title: response.success,
                        })
                    });
                    // Atualize a página ou faça outras ações necessárias
                    button.parent().parent().parent().remove()
                    $('#table2').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    $(document).add(function() {
                        Toast.fire({
                            icon: 'error',
                            title: error,
                        })
                    });
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
<script>
$("#refresh").click(function(){
    $("#table2").DataTable().ajax.reload();
});
</script>
@endpush
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)