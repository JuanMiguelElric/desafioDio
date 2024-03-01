@extends('adminlte::page')
@section('title', "Processos da empresa $empresa->nome")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>Terceiros</h1>
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
        <a href="{{route('empresas.terceiros.paginado', ['empresa'=> $empresa->id, 'limit'=> 10])}}" class="btn btn-primary mb-2" >todos os terceiros</a>
        <a href="{{route('empresas.terceiros.create', ['empresa'=> $empresa->id])}}" class="btn btn-success mb-2" >Adicionar terceiro</a>
        {{-- <button class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddTerceiro" id="addBotao">Adicionar Terceiro</button> --}}
        @include('data-mapping.terceiro.components.datatable', [
            'idBotao' => '#refresh',
            'idTable' => '#table5',
        ])
        @include('data-mapping.terceiro.components.modalEdit')
        @include('data-mapping.terceiro.components.modalAdd')
        
    </div>

    <x-footer />
@endsection
@prepend('js')
<script src="{{asset('resources/js/jquery.mask.js')}}"></script>
@endprepend
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
