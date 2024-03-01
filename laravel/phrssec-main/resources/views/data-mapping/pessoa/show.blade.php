@extends('adminlte::page')
@section('title', "$pessoa->nome_completo")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ $pessoa->nome_completo }}</h1>
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
        <x-adminlte-card title="{{ $pessoa->nome_completo }}" theme="light" theme-mode="full" class="elevation-3 text-black"
            body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
            icon="" collapsible>

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <x-adminlte-input disabled id="nome_completo" name="nome_completo"
                        placeholder="Nome do pessoa analisado" label="Nome da pessoa analisado"
                        value="{{ $pessoa->nome_completo }}" />
                    
                    <x-adminlte-input disabled id="nome_social" label="Nome Social" name="nome_social"
                        placeholder="Nome social da pessoa" value="{{ $pessoa->nome_social }}" />

                    <x-adminlte-input disabled id="cpf" label="CPF" name="cpf"
                        placeholder="Nº do cpf da pessoa" value="{{ $pessoa->cpf }}" />

                    <x-adminlte-input disabled id="email" label="E-mail de contato da pessoa"
                        name="email" placeholder="E-mail da pessoa ou ponto focal da pessoa"
                        value="{{ $pessoa->email }}" />
                    <x-adminlte-input disabled id="telefone" label="Telefone de contato da pessoa"
                        name="telefone"
                        placeholder="Número de telefone da pessoa"
                        value="{{ $pessoa->telefone }}" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input disabled id="codigo" name="cod" label="Código" value="{{ $pessoa->cod }}" />
                        <x-adminlte-input disabled id="created_at" name="created_at" label="Criado em"
                        value="{{ $pessoa->created_at->format('d/m/Y H:i:s') }}" />
                        <x-adminlte-input disabled id="updated_at" name="updated_at" label="Atualizado em"
                        value="{{ $pessoa->updated_at->format('d/m/Y H:i:s') }}" />
                    </div>
                    

                </div>
            </div>
            <x-slot name="footerSlot">
                <a href="{{ route('pessoa.edit', $pessoa->id) }}" class="btn btn-primary"
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
            $("#cpf").mask('000.000.000-00');
        })
    </script>
@endpush
