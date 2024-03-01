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
            <form action="{{ route('terceiros.update', $terceiro->id) }}" id="form" method="POST">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <x-adminlte-input id="nome_terceiro" name="nome_terceiro" placeholder="Nome do terceiro analisado"
                            label="Nome do terceiro analisado" value="{{ $terceiro->nome_terceiro }}" />



                        <x-adminlte-input id="site_terceiro" label="Site do terceiro" name="site_terceiro"
                            placeholder="Link do website do terceiro" value="{{ $terceiro->site_terceiro }}" />
                        <x-adminlte-input id="cnpj_terceiro" label="CNPJ do Terceiro" name="cnpj_terceiro"
                            placeholder="Nº do CNPJ do terceiro" value="{{ $terceiro->cnpj_terceiro }}" />
                        <x-adminlte-input id="nome_do_representante" label="Nome do contato do terceiro"
                            name="nome_do_representante"
                            placeholder="Nome completo do representante ou ponto focal do terceiro"
                            value="{{ $terceiro->nome_do_representante }}" />
                        <x-adminlte-input id="email_do_representante" label="E-mail de contato do Terceiro"
                            name="email_do_representante" placeholder="E-mail do representante ou ponto focal do terceiro"
                            value="{{ $terceiro->email_do_representante }}" />
                        <x-adminlte-input id="telefone_do_representante" label="Telefone de contato do Terceiro"
                            name="telefone_do_representante"
                            placeholder="Número de telefone do representante ou ponto focal do terceiro"
                            value="{{ $terceiro->telefone_do_representante }}" />
                    </div>
                </div>
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button type="submit" label="Editar" form="form" class="btn btn-primary" theme="primary"
                    id="btn-submit" />
            </x-slot>

        </x-adminlte-card>
    </div>
    <x-errors.erro-ajax />
@endsection
@prepend('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endprepend

@push('js')
    <script>
        $(document).ready(function() {
            $("#telefone_do_representante").mask('(00) 0000-00009');
            $("#cnpj_terceiro").mask('00.000.000/0000-00');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#form").submit(function() {
                $("#telefone_do_representante").unmask();
                $("#cnpj_terceiro").unmask();
            })
        });
    </script>
@endpush
