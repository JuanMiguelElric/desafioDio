@extends('adminlte::page')
@section('title', 'pessoa')

@section('content_header')
  <div class="row">
    <div class="col-sm-6">
        <h1>Registro de pessoa</h1>
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
        <div class="col-sm-12">
            <x-adminlte-card title="Registrar nova pessoa" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('empresas.pessoa.store', $empresa->id) }}" method="POST" id="form">
                    @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="nome_completo" placeholder="Nome Completo"
                                            label="Nome Completo" value="{{ old('nome_completo') }}" />
                                <x-adminlte-input name="nome_social" placeholder="Nome que quero ser chamado"
                                            label="Nome que quero ser chamado(a)" value="{{ old('nome_social') }}" />
                                            
                                <x-adminlte-input name="cpf" placeholder="000.000.000-00"
                                            label="CPF" data-mask="000.000.000-00" value="{{ old('cpf') }}" />
                            
                                <x-adminlte-input name="telefone" placeholder="(XX) xxxxx-xxxx"
                                            label="Telefone" data-mask="(00) 00000-0000" value="{{ old('telefone') }}" />
                            
        
                                <div class="form-check">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="possui-whatsapp" name="whatsapp" value="true">
                                    <label class="form-check-label" for="possui-whatsapp">
                                        Esse telefone possui Whatsapp
                                    </label>
                            

                                </div>
                                <x-adminlte-input name="email" placeholder="Digite seu email"
                                label="Email"  value="{{ old('email') }}" />
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Adicionar foto</label>
                                </div>
                            
        
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button type="submit" form="form" class="d-flex ml-auto" theme="primary"
                                label="Enviar" icon="fas fa-sign-in" />
                        </x-slot>
                    </form>
            </x-adminlte-card>
        </div>
    </div>
  </div>
  

@endsection
@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // Adiciona um listener para o evento change no checkbox
            $('#possui-whatsapp').change(function() {
                // Captura o estado do checkbox
                var isChecked = $(this).is(':checked');
                // Define o valor de whatsapp com base no estado do checkbox
                $('input[name="whatsapp"]').val(isChecked ? 'true' : 'false');
            });
        });
    </script>
  <script>
    $(document).ready(function(){
        const campoRequired = "Por favor preencher esse campo";
        $('#form').validate({
            rules:{
                nome_completo: "required",
                nome_social: "required",
                cpf: "required",
                telefone: "required",
                email: "required",
            },
            messages:{
                nome_completo: campoRequired,
                nome_social: campoRequired,
                cpf: campoRequired,
                telefone: campoRequired,
                email: campoRequired
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
            submitHandler: function(form) {
                $('#cpf').unmask();
                $('#telefone').unmask();
                console.log(form.serialize());
                return;
                // form.submit();
            }

        });
    });
  </script>
@endpush
