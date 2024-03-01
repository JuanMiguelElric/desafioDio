@php
    use App\Enums\DataMapping\BaseLegalEnum;
    use App\Enums\DataMapping\TipoArmazenamentoEnum;
    use App\Enums\DataMapping\TratamentoRealizadoEnum;
    use App\Enums\DataMapping\VolumeDeDadosPessoaisEnum;
    use Illuminate\Support\Facades\Vite;
@endphp
@extends('adminlte::page')
@section('title', "pessoas da empresa: $empresa->nome")
@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>pessoas</h1>
        </div>
        @isset($breadcrumb)
            <div class="col-sm-6">
                <x-breadcrumb :breadcrumb="$breadcrumb" />
            </div>
        @endisset
    </div>
@endsection
@push('css')
    <style>
        .radioCustom {
            cursor: pointer;
        }
    </style>
@endpush()
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <x-adminlte-select name="limit">
                <x-adminlte-options :options="[
                    '10'  => 'Mostrar 10 linhas',
                    '50'  => 'Mostrar 50 linhas',
                    '100' => 'Mostrar 100 linhas',
                ]" selected="{{ $limit }}" />
            </x-adminlte-select>
            {{ $pessoas->links() }}
        </div>
        @php
            $i = 1;
        @endphp
        @foreach ($pessoas as $pessoa)
        <x-adminlte-card title="{{ $pessoa->nome_completo }}" theme="light" theme-mode="full" class="elevation-3 text-black collapsed-card custom-collapsed-card"
            body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
            icon="" collapsible>

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <x-adminlte-input disabled id="{{$i}}nome_completo" name="nome_completo"
                        placeholder="Nome do pessoa analisado" label="Nome do pessoa analisado"
                        value="{{ $pessoa->nome_completo }}" />


                    <x-adminlte-input disabled id="{{$i}}cpf" label="Cpf do pessoa" name="cpf"
                        placeholder="Nº do Cpf do pessoa" value="{{ $pessoa->cpf }}" data-mask="00.000.000/0000-00"/>
                    <x-adminlte-input disabled id="{{$i}}nome_do_representante" label="Nome do representante"
                        name="nome_contato_pessoa" placeholder=""
                        value="{{ $pessoa->nome_do_representante }}" />
                    <x-adminlte-input disabled id="{{$i}}email_do_representante" label="E-mail do representante"
                        name="email_contato_pessoa" placeholder="E-mail do representante ou ponto focal do pessoa"
                        value="{{ $pessoa->email_do_representante }}" />
                    <x-adminlte-input disabled id="{{$i}}telefone_do_representante" label="Telefone do representante"
                        name="telefone_contato_pessoa"
                        placeholder="Número de telefone do representante ou ponto focal do pessoa"
                        value="{{ $pessoa->telefone_do_representante }}" data-mask="(00) 0000-00009"/>
                    
                </div>
                <div class="col-md-4">
                    <x-adminlte-input disabled id="{{$i}}cod" name="cod"
                        placeholder="" label="Código"
                        value="{{ $pessoa->cod }}" />
                    <x-adminlte-input disabled id="{{$i}}created_at" name="created_at"
                        placeholder="" label="Criado em"
                        value="{{ $pessoa->created_at }}" />
                    <x-adminlte-input disabled id="{{$i}}updated_at" name="updated_at"
                        placeholder="" label="Atualizado em"
                        value="{{ $pessoa->created_at }}" />
                </div>
            </div>
            <x-slot name="footerSlot">
                <a href="{{ route('pessoas.edit', $pessoa->id) }}" class="btn btn-primary"
                    style="color: white !important; font-weight:600;">editar</a>
            </x-slot>

        </x-adminlte-card>
        @php
            $i++;
        @endphp
    @endforeach
   
    {{ $pessoas->links() }}
</div>
<x-errors.erro-ajax />

{{-- Setup data for datatables --}}

<x-footer />
@endsection
@push('js')
<script src="{{asset('resources/js/jquery.mask.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.custom-collapsed-card').find('.fa-minus').removeClass('fa-minus').addClass('fa-plus');
    });
</script>
@endpush
@push('js')
<script>
    $('#limit').change(function() {
        // Redirecionar para o URL selecionado no dropdown
        var urlParams = new URLSearchParams(window.location.search);
        var url = "";
        switch ($(this).val()) {
            case "10":
                url = "{{ route('empresas.pessoa.paginado', ['empresa' => $empresa->id, 'limit' => 10]) }}";
                break;
            case "50":
                url = "{{ route('empresas.pessoa.paginado', ['empresa' => $empresa->id, 'limit' => 50]) }}";
                break;
            case "100":
                url =
                    "{{ route('empresas.pessoa.paginado', ['empresa' => $empresa->id, 'limit' => 100]) }}";
                break;
        }
        // console.log(url, $(this).val());
        window.location.href = url + "?page=" + 1;
        return;
    });
</script>
@endpush
@push('js')
<script>
    $(document).ready(function() {
        $('.custom-collapsed-card').find('.fa-minus').removeClass('fa-minus').addClass('fa-plus');
    });
</script>
@endpush

@section('plugins.BootstrapSelect', true)
