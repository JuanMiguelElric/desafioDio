@extends('adminlte::page')
@section('title', "Pessoa $empresa->nome")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>Pessoas</h1>
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

    <button class="btn-primary btn mb-2">Atualizar</button>
    <a href="{{route('empresas.pessoa.paginado', ['empresa'=> $empresa->id, 'limit'=> 10])}}" class="btn btn-primary mb-2" >todos as pessoas</a>
    <a href="{{route('empresas.pessoa.create', ['empresa'=> $empresa->id])}}" class="btn btn-success mb-2" >Adicionar pessoas</a>
    {{-- <button class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddTerceiro" id="addBotao">Adicionar Pessoas</button> --}}
    @include('data-mapping.pessoa.component.datatable', [
            'idBotao' => '#refresh',
            'idTable' => '#table5',
    ])
    @include('data-mapping.pessoa.component.modalEdit')
    @include('data-mapping.pessoa.component.modalAdd')
        
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

