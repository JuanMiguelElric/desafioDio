@extends('adminlte::page')
@section('title','Exame')
@section('content_header')
<h1>Exame</h1>
@endsection

@section('content')
<div class="container">
    
    <x-adminlte-card title="Avaliação" theme="dark" theme-mode="outline" class="elevation-3" body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light" collapsible>
        <form action="/avaliacoes" method="post">
            @csrf
            <div class="card-body">
                <input type="hidden" name="json" value="false">
                <div class="form-group">
                    <x-adminlte-input label="Avaliação" name="titulo" type="text" placeholder="Adequações da LGPD" />
                </div>
                <div class="form-group">
                    <x-adminlte-select name="ativo" label="Ativo">
                        <option value="1">Ativo</option>
                        <option value="2">Inativo</option>
                    </x-adminlte-select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Gerar Avaliação" class="btn btn-primary" theme="primary" />
            </div>
        </form>


    </x-adminlte-card>
</div>

@endsection

@push('js')
<script>
</script>
@endpush