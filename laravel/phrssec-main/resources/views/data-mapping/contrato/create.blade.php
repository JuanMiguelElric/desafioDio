@extends('adminlte::page')
@section('title', 'Contrato')
@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Formulário para contratos</h1>
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
                <x-adminlte-card title="" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('terceiros.contratos.store', $terceiro->id) }}" method="POST" id="form">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <x-adminlte-input name="numero_do_contrato" placeholder="" label="Número do contrato"
                                    value="{{ old('numero_do_contrato') }}" maxlength="255" required />

                                <x-adminlte-input name="objeto_do_contrato" placeholder="" label="Objeto do contrato"
                                    value="{{ old('objeto_do_contrato') }}" maxlength="255" required />

                                <x-adminlte-input name="ano_do_fechamento_do_contrato" placeholder=""
                                    label="Ano do fechamento do contrato" value="{{ old('ano_do_fechamento_do_contrato') }}"
                                    data-mask="0000" required />

                                <x-adminlte-select name="status" label="Status do contrato">
                                    <x-adminlte-options :options="['Inativo', 'Ativo']" placeholder="Selecionar status do contrato..."
                                        selected="{{ old('status') ?? 1 }}" />
                                </x-adminlte-select>

                                <x-adminlte-select name="tipo_do_servico_prestado" label="Tipo de Serviço prestado"
                                    required>
                                    <x-adminlte-options :options="[
                                        'Consultoria' => 'Consultoria',
                                        'Operação' => 'Operação',
                                        'Regulatório' => 'Regulatório',
                                        'Estratégico' => 'Estratégico',
                                        'Tecnológico' => 'Tecnológico',
                                    ]"
                                        placeholder="Selecionar um tipo de serviço prestado..."
                                        selected="{{ old('tipo_do_servico_prestado') }}" />
                                </x-adminlte-select>

                                <x-adminlte-select name="importancia" label="Importância" required>
                                    <x-adminlte-options :options="[
                                        'Baixa' => 'Baixa',
                                        'Moderada' => 'Moderada',
                                        'Alta' => 'Alta',
                                        'Crítica' => 'Crítica',
                                    ]" placeholder="Selecionar Importância..."
                                        selected="{{ old('importancia') }}" />
                                </x-adminlte-select>

                                <x-adminlte-input name="responsavel_interno_do_contrato" placeholder=""
                                    label="Responsável interno do contrato"
                                    value="{{ old('responsavel_interno_do_contrato') }}" required />

                                <x-adminlte-select name="due_diligence" label="Due Diligence" required>
                                    <x-adminlte-options :options="[
                                        'Sim' => 'Sim',
                                        'Não' => 'Não',
                                        'Não aplicável' => 'Não aplicável',
                                    ]" placeholder="Selecionar..."
                                        selected="{{ old('due_diligence') }}" />
                                </x-adminlte-select>

                                <x-adminlte-select name="nivel_de_risco" label="Nível de risco" required>
                                    <x-adminlte-options :options="[
                                        'Baixo' => 'Baixo',
                                        'Médio' => 'Médio',
                                        'Alto' => 'Alto',
                                        'Crítico' => 'Crítico',
                                    ]" placeholder="Selecionar nível de risco..."
                                        selected="{{ old('nivel_de_risco') }}" />
                                </x-adminlte-select>
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
                    numero_do_contrato: {
                        required : true,
                        maxlength: 255
                    },
                    ano_do_fechamento_do_contrato: {
                        required : true,
                        maxlength: 4
                    },
                    objeto_do_contrato: {
                        required : true,
                        maxlength: 255
                    },
                    status                         : "required",
                    tipo_do_servico_prestado       : "required",
                    importancia                    : "required",
                    responsavel_interno_do_contrato: {
                        required : true,
                        maxlength: 255
                    },
                    due_diligence : "required",
                    nivel_de_risco: "required",
                },
                messages: {
                    numero_do_contrato: {
                        required : campoRequired,
                        maxlength: "O campo Número do contrato não pode ter mais de 255 caracteres."
                    },
                    ano_do_fechamento_do_contrato: {
                        required : campoRequired,
                        maxlength: "O campo Ano do fechamento do contrato não pode ter mais de 4 caracteres."
                    },
                    objeto_do_contrato: {
                        required : campoRequired,
                        maxlength: "O campo Objeto do contrato não pode ter mais de 255 caracteres."
                    },
                    status                         : campoRequired,
                    tipo_do_servico_prestado       : campoRequired,
                    importancia                    : campoRequired,
                    responsavel_interno_do_contrato: {
                        required : campoRequired,
                        maxlength: "O campo Responsável interno do contrato não pode ter mais de 255 caracteres."
                    },
                    due_diligence : campoRequired,
                    nivel_de_risco: campoRequired,
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
                    $('#telefone_contato_terceiro').unmask();
                    console.log(form.serialize())
                    return;
                    // form.submit();
                }

            });
        })
    </script>
@endpush
