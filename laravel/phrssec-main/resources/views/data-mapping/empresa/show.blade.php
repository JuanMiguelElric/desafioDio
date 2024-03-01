@extends('adminlte::page')
@section('title', $empresa->nome)
@section('content_header')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h1>Editar {{ $empresa->nome }}</h1>
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
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $empresa->nome }}</h3>
                    </div>
                        <div class="card-body">
                            <x-adminlte-input disabled label="Nome" name="edit_nome"  type="text"
                                placeholder="nome da empresa" id="nome" value="{!! $empresa->nome !!}" />
                            <x-adminlte-input disabled label="CNPJ" name="edit_cnpj"  type="text"
                                placeholder="00.000.000/0000-00" id="cnpj" value="{{ $empresa->cnpj }}" data-mask="00.000.000/0000-00" />
                            <x-adminlte-input disabled label="Telefone" name="edit_telefone"  type="text"
                                placeholder="(00) 00000-0000" id="telefone" value="{{ $empresa->telefone }}" data-mask="(00) 00000-0000"/>
                            <x-adminlte-input disabled label="E-mail" name="edit_email"  type="email"
                                placeholder="example@example.com" id="email" value="{{ $empresa->email }}" />
                            
                            <div class="form-group">
                                <label for="status">Status</label>
                                <x-adminlte-select disabled name="edit_status">
                                    <x-adminlte-options :options="['Inativo', 'Ativo']" selected="1" id="status" />
                                </x-adminlte-select>
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observações</label>
                                <x-adminlte-textarea disabled name="edit_observacao" 
                                    placeholder="Insira uma observação..." id="observacao" rows="5">
                                    {{ $empresa->observacao }}
                                </x-adminlte-textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{route('empresas.edit', $empresa->id)}}" class="btn btn-primary">Editar</a>
                        </div>
                </div>
            </div>
            @if ($empresa->has('filiais'))
                <div class="col-md-4">
                    @foreach ($empresa->filiais as $filial)
                    <x-adminlte-card title="{{$filial->nome}}" theme="primary" icon="" collapsible>
                        <x-adminlte-input disabled name="" label="Nome" type="text"
                            value="{{ $filial->nome }}" class="mr-2" />
                        <x-adminlte-input disabled name="" label="CNPJ" type="text"
                            value="{{ $filial->cnpj }}" data-mask="00.000.000/0000-00" />
                    </x-adminlte-card>
                    @endforeach
            @endif
            <x-adminlte-modal id="modalMin" title="exclusão">
                <div>Tem certeza que quer excluir?</div>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel" />
                    <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
                </x-slot>
            </x-adminlte-modal>
        </div>
    </div>
    </div>
    </div>


    <x-footer />
@endsection
@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endpush

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
