{{-- Configuração dos dados para o DataTables --}}
@php
    $heads = [ 'ID','Nome Completo', 'Nome Social', ['label' => 'CPF', 'width' => 10], 'Telefone', 'WhatsApp',['label' => 'Cargo', 'no-export' => true, 'width' => 5],['label' => 'Actions', 'no-export' => true, 'width' => 5]];

    $config = [
        'ajax' => [
            'url' => route('empresas.pessoa.json', $empresa->id),
            'dataSrc' => 'pessoas',
            'type' => 'GET',
            'data' => ['_token' => csrf_token()],
        ],
        'data' =>[
            
        ],
        'autofill' => true,
        'order' => [[0, 'desc']],
        'columns' => [
            ['data'=>'id'],
            ['data' => 'nome_completo'],
            ['data' => 'nome_social'],
            ['data' => 'cpf'],
            ['data' => 'telefone'],
            ['data' => 'whatsapp'],
            ['data' => 'btns_cargos'],
            ['data' => 'btns']
        ],
    ];
@endphp

<x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable />
<x-adminlte-modal id="modalMin" title="Exclusão">
    <div>Tem certeza que deseja excluir?</div>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancel" />
        <x-adminlte-button class="mr-auto" theme="success" label="Confirmar" id="confirmation" />
    </x-slot>
</x-adminlte-modal>

@push('js')
    <script>
        $("{{ $idBotao }}").click(function() {
            $("{{ $idTable }}").DataTable().ajax.reload();
        })
    </script>

    <script src="{{ asset('resources/js/requisicaoAjax.js') }}"></script>
@endpush
@push('js')
@include('data-mapping.pessoa.component.delete')
@endpush

