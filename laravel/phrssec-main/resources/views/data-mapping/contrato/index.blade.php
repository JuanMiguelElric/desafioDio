@extends('adminlte::page')
@section('title', 'Contratos')
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>Contratos</h1>
            </div>
            @isset($breadcrumb)
                <div class="col-sm-6">
                    <x-breadcrumb :breadcrumb="$breadcrumb" />
                </div>
            @endisset
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary mb-2" id="refresh">Atualizar</button>
        {{-- <a href="{{ route('empresas.terceiros.paginado', ['empresa' => $empresa->id, 'limit' => 10]) }}"
            class="btn btn-primary mb-2">todos os terceiros</a> --}}
        <a href="{{ route('terceiros.contratos.create', ['terceiro' => $terceiro->id]) }}" class="btn btn-success mb-2">Adicionar
            contrato</a>
        {{-- <button class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddTerceiro" id="addBotao">Adicionar Terceiro</button> --}}


        <div class="row">
            <div class="col-md-12">
                @php
                    $heads = ['ID', 'Nº contrato', 'Ano do contrato', 'Status', 'Due Diligence', 'Nível de risco', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];

                    $config = [
                        'ajax' => [
                            'url' => route('terceiros.contratos.index.json', $terceiro->id),
                            'dataSrc' => 'contratos',
                            'type' => 'GET',
                            'data' => ['_token' => csrf_token()],
                        ],
                        'data' => [],
                        'order' => [[0, 'desc']],
                        'columns' => [['data' => 'id'], ['data' => 'n'], ['data' => 'a'], ['data' => 's'], ['data' => 'dd'], ['data' => 'nr'], ['data' => 'btns']],
                    ];
                @endphp

                <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable />
            </div>
        </div>

    </div>

    <x-footer />
@endsection
@prepend('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endprepend
@push('js')
    <script>
        $(document).on('click', '.btn-delete', function() {
            let dadoId = $(this).data('dado-id');
            let url = '{{ route('contratos.destroy', ':dadoId') }}';
            let data = {
                '_token': '{{ csrf_token() }}'
            };
            url = url.replace(":dadoId", dadoId);
            // confirmDelete();
           confirmDelete(url, data, "DELETE")

        })
    </script>
    <script>
        function confirmDelete(url, data, method) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você realmente deseja excluir este item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: method,
                        url: url,
                        data: data,
                        success: function(response) {
                            Swal.fire(
                                'Excluído!',
                                response.message,
                                'success'
                            );
                            $('#table5').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            toastr.warning(xhr.responseJSON);
                        }
                    })
                }
                return;
            });
        }
    </script>
@endpush
@push('js')
<script>
    $("#refresh").click(function() {
        $("#table5").DataTable().ajax.reload();
    })
</script>
@endpush
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
