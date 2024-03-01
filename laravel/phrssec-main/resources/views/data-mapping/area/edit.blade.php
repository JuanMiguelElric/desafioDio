@extends('adminlte::page')
@section('title',"Editar $area->nome" )
@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar {{$area->nome}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            <div class="card-body">
                @method('PUT')
                @csrf
                <input type="hidden" name="json" value="false" />
                <div class="form-group">
                    <x-adminlte-input id="nome" label="Nome" name="nome" type="text"  placeholder="Operacional" value="{{$area->nome}}" />
                </div>
                <div class="form-group">
                    <x-adminlte-select name="status"  label="Status">
                        <option value="1">Ativo</option>
                        <option value="0" @if ($area->status == 0)
                            selected
                            @endif >
                            Inativo
                        </option>
                    </x-adminlte-select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar Empresa" class="btn btn-primary" theme="primary" />
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
            if(!confirm('tem certeza que quer excluir {{$area->nome}} ?')){
                return
            }
            $.ajax({
                type: 'DELETE',
                url: "{{route('areas.destroy', $area->id)}}",
                data: formData,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias

                    toastr.success(response.message)
                    setInterval(() => {
                        window.location.href = "{{route('areas.index')}}";
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
        $('#form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                type: 'PUT',
                url: "{{route('areas.update', $area->id)}}",
                data: formData,
                success: function(response) {
                    // Lógica de sucesso
                    // alert(response.message);
                    // Atualize a página ou faça outras ações necessárias
                    toastr.success(response.message)

                    setInterval(() => {
                        window.location.href= "{{route('areas.index')}}";
                    }, 2000);

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