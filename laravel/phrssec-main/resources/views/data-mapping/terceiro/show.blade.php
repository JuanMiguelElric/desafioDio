@extends('adminlte::page')
@section('title', "$terceiro->nome_terceiro")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ $terceiro->nome_terceiro }}</h1>
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
        <x-adminlte-card title="{{ $terceiro->nome_terceiro }}" theme="light" theme-mode="full" class="elevation-3 text-black"
            body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
            icon="" collapsible>

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <x-adminlte-input disabled id="nome_terceiro" name="nome_terceiro"
                        placeholder="Nome do terceiro analisado" label="Nome do terceiro analisado"
                        value="{{ $terceiro->nome_terceiro }}" />
                    
                    <x-adminlte-input disabled id="site_terceiro" label="Site do terceiro" name="site_terceiro"
                        placeholder="Link do website do terceiro" value="{{ $terceiro->site_terceiro }}" />
                    <x-adminlte-input disabled id="cnpj_terceiro" label="CNPJ do Terceiro" name="cnpj_terceiro"
                        placeholder="Nº do CNPJ do terceiro" value="{{ $terceiro->cnpj_terceiro }}" />
                    <x-adminlte-input disabled id="nome_do_representante" label="Nome do contato do terceiro"
                        name="nome_contato_terceiro" placeholder="Nome completo do representante ou ponto focal do terceiro"
                        value="{{ $terceiro->nome_do_representante }}" />
                    <x-adminlte-input disabled id="email_do_representante" label="E-mail de contato do Terceiro"
                        name="email_contato_terceiro" placeholder="E-mail do representante ou ponto focal do terceiro"
                        value="{{ $terceiro->email_do_representante }}" />
                    <x-adminlte-input disabled id="telefone_do_representante" label="Telefone de contato do Terceiro"
                        name="telefone_contato_terceiro"
                        placeholder="Número de telefone do representante ou ponto focal do terceiro"
                        value="{{ $terceiro->telefone_do_representante }}" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input disabled id="codigo" name="cod" label="Código" value="{{ $terceiro->cod }}" />
                    <x-adminlte-input disabled id="created_at" name="created_at" label="Criado em"
                        value="{{ $terceiro->created_at->format('d/m/Y H:i:s') }}" />
                    <x-adminlte-input disabled id="updated_at" name="updated_at" label="Atualizado em"
                        value="{{ $terceiro->updated_at->format('d/m/Y H:i:s') }}" />
                </div>
            </div>
            <x-slot name="footerSlot">
                <a href="{{ route('terceiros.edit', $terceiro->id) }}" class="btn btn-primary"
                    style="color: white !important; font-weight:600;">editar</a>
            </x-slot>

        </x-adminlte-card>
    </div>
@endsection
@prepend('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endprepend

@push('js')
    <script>
        $(document).ready(function() {
            $("#telefone_contato_terceiro").mask('(00) 90000-0000');
            $("#cnpj_terceiro").mask('00.000.000/0000-00');
        })
    </script>
@endpush
