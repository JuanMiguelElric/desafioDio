@extends('adminlte::page')
@section('title', "$cargo->nome_do_cargo")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ $cargo->nome_do_cargo }}</h1>
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
        <x-adminlte-card title="{{ $cargo->nome_do_cargo }}" theme="light" theme-mode="full" class="elevation-3 text-black"
            body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
            icon="" collapsible>

            @csrf
            @method('PUT')
            <form action="{{ route('cargo.update', $cargo->id) }}" id="form" method="POST">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <x-adminlte-input id="nome_completo" name="nome_completo" placeholder="Nome do cargo"
                            label="Nome do cargo " value="{{ $cargo->nome_do_cargo }}" />

      
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






