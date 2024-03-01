@extends('adminlte::page')
@section('title','Nova pergunta')
@section('content_header')
<!-- <h1>Perguntas</h1> -->
@endsection
@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">nova pergunta</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            <div class="card-body">
                @csrf
                <input type="hidden" name="json" value="true">
                <div class="form-group">
                    <x-adminlte-select name="avaliacao" label="Avaliação">
                        <option value="" selected>selecionar</option>
                        @foreach ($avaliacoes as $avaliacao)
                        <option value="{{$avaliacao->id}}">{{$avaliacao->titulo}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="titulo" label="Pergunta" type="text" placeholder=" 1 - o que é LGPD?" />
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Gerar pergunta" class="btn btn-primary" theme="primary" />
            </div>
        </form>
    </div>
</div>
<x-footer />
@endsection
@push('js')
<script>
    var Toast = 
    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type   : 'POST',
                url    : "/perguntas",
                data   : formData,
                success: function(response) {
                    console.log(response)
                    toastr.success(response.success);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText)
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }

            })
        });
    });
</script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)