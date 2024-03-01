@extends('adminlte::page')
@section('title', 'Inserir Cargo')
@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Cargos</h1>
        </div>
        @isset($breadcrumb)
            <div class="col-sm-6">
                <x-breadcrumb :breadcrumb="$breadcrumb" />
            </div>
        @endisset
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <x-adminlte-card title="Cargo" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('empresas.cargo.store', $empresa->id) }}" method="POST" id="form">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="nome_do_cargo" placeholder="Nome do cargo"
                                    label="Nome do cargo" value="{{ old('nome_do_cargo') }}" />
                                
                                
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button type="submit" form="form" class="d-flex ml-auto" theme="primary"
                                label="enviar" icon="fas fa-sign-in" />
                        </x-slot>
                    </form>
                </x-adminlte-card>
            </div>
        </div>
    </div>

    <x-footer />

@endsection
@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endpush
@push('js')
<script>
    $(document).ready(function(){
        const campoRequired = "Por favor preencher esse campo";
        $('#form').validate({
            rules:{
                nome_do_cargo: "required",
              
            },
            messages:{
                nome_do_cargo: campoRequired,
                
            },
            errorElement: 'span',
            errorPlacement:function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-valid');
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
           

        });
    });
  </script>
@endpush
