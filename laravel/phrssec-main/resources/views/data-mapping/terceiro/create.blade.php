@extends('adminlte::page')
@section('title', 'Inserir Terceiro')
@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Terceiros</h1>
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
                <x-adminlte-card title="Terceiro" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('empresas.terceiros.store', $empresa->id) }}" method="POST" id="form">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="nome_terceiro" placeholder="Nome do terceiro"
                                    label="Nome do terceiro" value="{{ old('nome_terceiro') }}" />

                                
                                <x-adminlte-input name="cnpj_terceiro" placeholder="00.000.000/0000-00"
                                label="CNPJ do terceiro" data-mask="00.000.000/0000-00"
                                value="{{ old('cnpj_terceiro') }}" />

                                <x-adminlte-input name="nome_do_representante" placeholder="Nome do representante"
                                label="Nome do representante" value="{{ old('nome_do_representante') }}" />
                                
                                <x-adminlte-input name="email_do_representante" placeholder="Email do representante"
                                    label="Email do representante" value="{{ old('email_do_representante') }}" />
                                    
                                <x-adminlte-input name="telefone_do_representante" placeholder="(00) 00000-0000"
                                label="Telefone do representante" data-mask="(00) 90000-0000"
                                value="{{ old('telefone_do_representante') }}" />
                                
                                <x-adminlte-input name="site_terceiro" placeholder="Site terceiro" label="Site terceiro"
                                    value="{{ old('site_terceiro') }}" />
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
        $(document).ready(function() {


            const campoRequired = "Por favor, preencha este campo";
            $('#form').validate({
                rules: {
                    nome_terceiro: "required",
                    descricao: "required",
                    localizacao_fisica_pais_estado: "required",
                    //id_ativo                      : "required",
                    //ativo_sis_doc                 : "required",
                    responsavel_interno_ativo: "required",
                    tipo_servico_prestado: "required",
                    status: "required",
                    importancia: "required",
                    site_terceiro: "required",
                    cnpj_terceiro: "required",
                    nome_contato_terceiro: "required",
                    email_contato_terceiro: {
                        required: true,
                        email: true
                    },
                    telefone_contato_terceiro: "required",
                    responsavel_interno_terceiro: "required",
                },
                messages: {
                    nome_terceiro: campoRequired,
                    descricao: campoRequired,
                    localizacao_fisica_pais_estado: campoRequired,
                    // id_ativo                      : campoRequired,
                    //ativo_sis_doc                 : campoRequired,
                    responsavel_interno_ativo: campoRequired,
                    tipo_servico_prestado: campoRequired,
                    status: campoRequired,
                    importancia: campoRequired,
                    site_terceiro: campoRequired,
                    cnpj_terceiro: campoRequired,
                    nome_contato_terceiro: campoRequired,
                    email_contato_terceiro: {
                        required: campoRequired,
                        email: "Por favor, insira um endereço de e-mail válido"
                    },
                    telefone_contato_terceiro: campoRequired,
                    responsavel_interno_terceiro: campoRequired,
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
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
                    // Este bloco é executado quando o formulário é validado com sucesso
                    // Você pode adicionar código aqui para enviar o formulário, se necessário
                    $('#cnpj_terceiro').unmask();
                    $('#telefone_do_representante').unmask();
                    console.log(form.serialize())
                    return;
                    // form.submit();
                }

            });
        })
    </script>
@endpush
