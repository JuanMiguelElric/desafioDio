@extends('adminlte::page')
@section('title','Nova alternativa')
@section('content_header')
<!-- <h1>Alternativas</h1> -->
@endsection
@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">nova alternativa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            <div class="card-body">
                @csrf
                <input type="hidden" name="json" value="true">
                <div class="form-group">
                    <x-adminlte-select id="avaliacao" name="avaliacao" label="Avaliação">
                        <option value="" selected>selecionar</option>
                        @foreach ($avaliacoes as $avaliacao)
                        <option value="{{$avaliacao->id}}">{{$avaliacao->titulo}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <x-adminlte-select id="perguntas" name="pergunta" label="Pergunta">
                        <option value="" selected>selecionar pergunta</option>
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="opcao" label="Alternativa" type="text" placeholder=" 1 - o que é LGPD?" />
                </div>
                <div class="form-group">
                    <x-adminlte-select id="correto" name="verdadeiro" label="Alternativa correta">
                        <option value="0" selected>incorreto</option>
                        <option value="1" selected>correto</option>
                    </x-adminlte-select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Gerar alternativa" class="btn btn-primary" theme="primary" />
                    <a href="/perguntas/create" class="btn btn-success d-none" id="btn-editar">Criar pergunta</a>
            </div>
        </form>
    </div>
</div>
<x-footer />
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                type: 'POST',
                url:'/alternativas',
                data: formData,
                success: function(response) {
                    console.log(response)
                    toastr.success(response.success);
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText)
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }

            })
        });

    });
    $("#avaliacao").change(function() {
        var valorSelecionado = $(this).val();
        if (valorSelecionado == "") {
            $('#perguntas').empty()
            $('#perguntas').append(
                `<option value="#">selecionar avaliação primeiro</option>`
            )
            return
        }
        console.log(valorSelecionado);
        $.ajax({
            type: 'GET',
            url: '/perguntasJson/' + valorSelecionado,
            success: function(response) {
                // Lógica de sucesso
                // Atualize a página ou faça outras ações necessárias
                $('#perguntas').empty()
                $.each(response.perguntas, function(index, {
                    id,
                    titulo
                }) {
                    $('#perguntas').append(
                        `<option value="${id}">${titulo}</option>`
                    )
                })
                $('#btn-editar').addClass('d-none');


            },
            error: function(xhr, status, error) {
                // Lógica de erro
                // console.error(xhr.responseText);
                toastr.warning(xhr.responseJSON.error)
                $('#perguntas').empty()
                $('#perguntas').append(
                    `<option value="#">${xhr.responseJSON.perguntas}</option>`
                )
                $('#btn-editar').removeClass('d-none');
            }
        });
    });
</script>
@endpush

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)