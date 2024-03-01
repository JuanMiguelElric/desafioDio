{{-- Setup data for datatables --}}
@php
    $heads = [['label' => 'ID', 'width' => 2], 'Código', 'Nome', 'Site', ['label'=>'CNPJ','width'=>10], 'Email', 'responsavel', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];

    $config = [
        'ajax' => [
            'url' => route('empresas.terceiros.json', $empresa->id),
            'dataSrc' => 'terceiros',
            'type' => 'GET',
            'data' => ['_token' => csrf_token()],
            
        ],
        'data' =>[
            
        ],
        'autofill' => true,
        'order' => [[0,'desc']],
        'columns' => [['data' => 'id'], ['data' => 'cod'], ['data' => 'nome'], ['data' => 'site'], ['data' => 'cnpj'], ['data' => 'email'], ['data' => 'responsavel'], ['data' => 'btns']],
    ];
@endphp

<x-adminlte-datatable id="table5" :heads="$heads" :config="$config"  striped hoverable />
<x-adminlte-modal id="modalMin" title="exclusão">
    <div>Tem certeza que quer excluir?</div>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel" />
        <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
    </x-slot>
</x-adminlte-modal>
@push('js')
    <script>
        $("{{ $idBotao }}").click(function() {
            $("{{ $idTable }}").DataTable().ajax.reload();
        })
    </script>

    <script src="{{asset('resources/js/requisicaoAjax.js')}}">
        
    </script>
@endpush
@push('js')
@include('data-mapping.terceiro.components.delete')
@endpush
