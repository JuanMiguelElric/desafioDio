@extends('adminlte::page')
@section('title', $departamento->nome)
@section('content_header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h1>{{$departamento->nome}}</h1>
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
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form" action="{{ route('departamentos.update', $departamento->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <x-adminlte-input label="Departamento" id="nome" name="nome" type="text"
                        placeholder="nome do departamento" value="{{$departamento->nome}}"  required/>

                    <x-adminlte-input label="Responsável" id="responsavel" name="responsavel" type="text"
                        placeholder="Responsável pelo departamento" value="{{$departamento->responsavel}}"  required/>

                    <x-adminlte-input label="Telefone" id="telefone" name="telefone" type="text"
                        placeholder="(00) 00000-0000" value="{{$departamento->telefone}}"  required/>

                    <x-adminlte-input label="E-mail" id="email" name="email" type="email"
                        placeholder="E-mail do responsável pelo departamento" value="{{$departamento->email}}" required/>

                    <div class="form-group">
                        <x-adminlte-select id="Status" name="status" label="Status" required>
                            <option value="0">Inativo</option>
                            <option value="1" @if($departamento->status == 1) selected @endif>Ativo</option>
                        </x-adminlte-select>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <x-adminlte-button type="submit" label="editar departamento" class="btn btn-primary" theme="primary"
                        id="btn-submit" />
                </div>
            </form>
        </div>
    </div>
    <x-footer />
@endsection
@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#telefone").mask('(00) 00000-0000');
        })
    </script>
@endpush
