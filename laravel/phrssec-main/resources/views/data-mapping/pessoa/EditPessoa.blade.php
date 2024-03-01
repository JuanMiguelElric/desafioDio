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
            <form action="{{ route('pessoa.update', $pessoa->id) }}" id="form" method="POST">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <x-adminlte-input id="nome_completo" name="nome_completo" placeholder="Nome completo"
                            label="Nome completo" value="{{ $pessoa->nome_completo }}" />

                        <x-adminlte-input id="nome_social" label="Nome que gostaria de ser chamado"
                        name="nome_social"
                        placeholder="Nome que deseja ser chamado"
                        value="{{ $pessoa->nome_social }}" />
    
                        <x-adminlte-input id="cpf" label="CPF da pessoa" name="cpf"
                            placeholder="CPF da pessoa" value="{{ $pessoa->cpf }}" />
                        <x-adminlte-input id="telefone" label="Telefone de pessoa"
                            name="telefone"
                            placeholder="Número de telefone da pessoa ou ponto focal da pessoa"
                            value="{{ $pessoa->telefone }}" />
                        <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="possui-whatsapp">
                                <label class="form-check-label" for="checkbox1">
                                    Esse telefone possui Whatsapp
                                </label>
                        </div>
                        <x-adminlte-input id="email" label="E-mail de contato da pessoa"
                            name="email" placeholder="E-mail da pessoa ou ponto focal da pessoa"
                            value="{{ $pessoa->email }}" />
                        <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Adicionar foto</label>
                        </div>
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
            // Adiciona um listener para o evento change no checkbox
            $('#possui-whatsapp').change(function() {
                // Captura o estado do checkbox
                var isChecked = $(this).is(':checked');
                // Define o valor de whatsapp com base no estado do checkbox
                $('input[name="whatsapp"]').val(isChecked ? 'true' : 'false');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#telefone").mask('(00) 0000-00009');
            $("#cpf").mask('000.000.000-00');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#form").submit(function() {
                $("#telefone").unmask();
                $("#cpf").unmask();
            })
        });
    </script>
@endpush
