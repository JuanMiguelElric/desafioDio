@extends('adminlte::page')
@section('title','Exames')
@section('content_header')
<h2 class="text-center">Avaliações</h2>
@endsection
@section('content')

<div class="container">

    @php
    $config = [
    "title" => "Select multiple options...",
    "liveSearch" => true,
    "liveSearchPlaceholder" => "Search...",
    "showTick" => true,
    "actionsBox" => true,
    ];
    @endphp
    <form action="{{route('admin.store')}}" method="POST" id="form">
        @csrf

        <x-adminlte-select2 name="avaliacao" label="Avaliação" data-placeholder="Select an option...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-info border border-secundary">
                    <i class="fa fa-university"></i>
                </div>
            </x-slot>
            <option />
            <div id="avaliacoes">
                @foreach($avaliacoes as $avaliacao)
                <option value="{{$avaliacao->id}}">{{$avaliacao->titulo}}</option>
                @endforeach
            </div>
        </x-adminlte-select2>

        <x-adminlte-select2 name="estudante" class="border" label="Estudante" data-placeholder="Select an option...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-info border border-secundary">
                    <i class="fa fa-graduation-cap"></i>
                </div>
            </x-slot>
            <option />
            <div id="estudantes">
                @foreach($estudantes as $estudante)
                <option value="{{$estudante->id}}">{{$estudante->email}}</option>
                @endforeach
            </div>
        </x-adminlte-select2>
        <x-adminlte-button type="submit" theme="primary" label="Atribuir aluno" />
    </form>

</div>
<x-footer />
@endsection


@push('js')
<script>
    $('#form').submit(function(event) {
        event.preventDefault();
        const formData = $(this).serialize()
        $.ajax({
            type: 'POST',
            url: "{{route('admin.store')}}",
            data: formData,
            success: function(res) {
                // Lógica de sucesso
                // alert(response.message);
                // Atualize a página ou faça outras ações necessárias
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $(document).add(function() {
                    Toast.fire({
                        icon: 'success',
                        title: res.message,
                    })
                });
                $('#table2').DataTable().ajax.reload();
                // console.log(response.card)
            },
            error: function(xhr, status, error) {
                // Lógica de erro
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $(document).add(function() {
                    Toast.fire({
                        icon: 'warning',
                        title: xhr.responseJSON.message,
                    })
                });
                // console.log(xhr.responseJSON);
            }
        });
    })
</script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)