@extends('adminlte::page')
@section('title',"Editar $avaliacao->titulo" )
@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar {{$avaliacao->titulo}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            <div class="card-body">
                @method('PUT')
                @csrf
                <input type="hidden" name="json" value="false" />
                <div class="form-group">
                    <x-adminlte-input id="titulo" label="Avaliação" name="titulo" type="text" disabled placeholder="Adequações da LGPD" value="{{$avaliacao->titulo}}" />
                </div>
                <div class="form-group">
                    <x-adminlte-select name="ativo" disabled label="Ativo">
                        <option value="1">Ativo</option>
                        <option value="0" @if ($avaliacao->ativo == 0)
                            selected
                            @endif >
                            Inativo
                        </option>
                    </x-adminlte-select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar Avaliação" class="btn btn-primary" theme="primary" />
        </form>
        <x-adminlte-button label="Editar" id="editar" theme="info" icon="fas fa-info-circle" />
        <form id="form-delete" class="mt-1">
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{$avaliacao->id}}">
            <x-adminlte-button type="submit" label="Excluir" theme="danger" icon="fa fa-trash" />
        </form>
    </div>
</div>
</div>
<x-footer />
@endsection
@push('js')
<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $("#editar").click(function() {
            $('input').removeAttr('disabled');
            $('select').removeAttr('disabled');

        });

        $("#form-delete").submit(function(event) {
            event.preventDefault()
            var formData = $(this).serialize();
            if(!confirm('tem certeza que quer excluir {{$avaliacao->titulo}} ?')){
                return
            }
            $.ajax({
                type: 'POST',
                url: '/avaliacoes/{{$avaliacao->id}}',
                data: formData,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias

                    toastr.success(response.success)
                    setInterval(() => {
                        window.location.href = "/avaliacoes";
                    }, 2000)

                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    // console.error(xhr.responseText);
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }
            });
        })
        $('#form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/avaliacoes/{{$avaliacao->id}}',
                data: formData,
                success: function(response) {
                    // Lógica de sucesso
                    // alert(response.message);
                    // Atualize a página ou faça outras ações necessárias
                    toastr.success(response.success)

                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    // console.error(xhr.responseText);
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }
            });
        })
    })
</script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)