@extends('adminlte::page')
@section('title','Alternativas')
@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$alternativa->opcao}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('alternativas.update', $alternativa->id)}}">
            <div class="card-body">
                @method('PUT')
                @csrf
                <input type="hidden" name="json" value="0">
                <div class="form-group">
                    <x-adminlte-input name="opcao" label="Alternativa" type="text" placeholder=" 1 - o que é LGPD?" value="{{$alternativa->opcao}}"/>
                </div>
                <div class="form-group">
                    <x-adminlte-select id="correto" name="verdadeiro" label="Alternativa correta">
                        <option value="0">incorreto</option>
                        <option value="1" 
                        @if($alternativa->verdadeiro)
                        selected
                        @endif
                        >correto</option>
                    </x-adminlte-select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar alternativa" class="btn btn-primary" theme="primary" />
            </div>
        </form>
    </div>
</div>
<x-footer />
@endsection
@push('js')
<script>
    
</script>
@endpush