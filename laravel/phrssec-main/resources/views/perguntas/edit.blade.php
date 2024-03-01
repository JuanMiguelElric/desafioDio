@extends('adminlte::page')
@section('title',"Editar $pergunta->titulo" )
@section('content_header')
<h1>{{$pergunta->titulo}}</h1>
@endsection
@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar {{$pergunta->titulo}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('perguntas.update',$pergunta->id)}}">
            <div class="card-body">
                @method('PUT')
                @csrf
                <input type="hidden" name="json" value="false" />
                <div class="form-group">
                    <x-adminlte-input id="titulo" label="Questão" name="titulo" type="text" placeholder="Adequações da LGPD" value="{{$pergunta->titulo}}" />
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar Questão" class="btn btn-primary" theme="primary" />
        </form>
        
    </div>
</div>
</div>
<x-footer />
@endsection
@push('js')
@endpush