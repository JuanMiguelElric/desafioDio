<x-adminlte-modal id="modalAddTerceiro" title="Adicionar Terceiro" theme="teal" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            @csrf
            <input type="hidden" name="json" value="1">
            <div class="card-body">
                <x-adminlte-input name="nome_terceiro" placeholder="Nome do terceiro analisado"
                    label="Nome do terceiro analisado" value="Teste nome do Terceiro" />
                <x-adminlte-input name="descricao" placeholder="Descrição" label="Descrição"
                    value="Teste nome do Terceiro" />
                <x-adminlte-input name="localizacao_fisica_pais_estado"
                    placeholder="Indicação da localização física do armazenamento"
                    label="Localização física do armazenamento" value="EUA - Texas" />
                {{-- <x-adminlte-input name="id_ativo" placeholder="ID do ativo" label="ID do ativo" value="id ativo 0001" /> --}}
                {{-- <x-adminlte-input name="ativo_sis_doc" placeholder="Nome do ativo (sistema ou documento) analisado"
                    label="Ativo (Sistema / Documento)" value="Nome do ativo" /> --}}
                <x-adminlte-input name="responsavel_interno_ativo"
                    placeholder="Responsável pelo terceiro dentro da empresa" label="Responsável Interno"
                    value="Responsavel interno" />
                <x-adminlte-select name="tipo_servico_prestado" label="Tipo de Serviço prestado">
                    <x-adminlte-options :options="[
                        'Consultoria' => 'Consultoria',
                        'Operação' => 'Operação',
                        'Regulatório' => 'Regulatório',
                        'Estratégico' => 'Estratégico',
                        'Tecnológico' => 'Tecnológico',
                    ]" placeholder="Selecione um tipo de serviço prestado..." />
                </x-adminlte-select>

                <x-adminlte-select name="status" label="Status">
                    <x-adminlte-options :options="[
                        'Ativo' => 'Ativo',
                        'Inativo' => 'Inativo',
                    ]" placeholder="Selecione o status..." />
                </x-adminlte-select>
                <x-adminlte-select name="importancia" label="Importância">
                    <x-adminlte-options :options="[
                        'Crítica' => 'Crítica',
                        'Alta' => 'Alta',
                        'Moderada' => 'Moderada',
                        'Baixa' => 'Baixa',
                    ]" placeholder="Selecione Importância..." />
                </x-adminlte-select>

                <x-adminlte-input name="site_terceiro" placeholder="Site terceiro" label="Site terceiro"
                    value="www.google.com" />
                <x-adminlte-input name="cnpj_terceiro" placeholder="Cnpj do terceiro" label="CNPJ do terceiro"
                    value="11.515.111/5555-4" data-mask="00.000.000/0000-00"/>
                <x-adminlte-input name="nome_contato_terceiro" placeholder="Nome para contato do terceiro"
                    label="Nome para contato do terceiro" value="Nome para contato do terceiro" />
                <x-adminlte-input name="email_contato_terceiro" placeholder="Email para contato do terceiro"
                    label="Email para contato do terceiro" value="example@example.com" />

                <x-adminlte-input name="telefone_contato_terceiro" placeholder="Telelfone para contato do terceiro"
                    label="Telefone para contato do terceiro" value="(13) 11111-1111" data-mask="(00) 00000-0000"/>

                <x-adminlte-input name="responsavel_interno_terceiro" placeholder="Responsável interno do terceiro"
                    label="Responsável interno do terceiro" value="Responsável interno do terceiro" />

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Inserir Terceiro" class="btn btn-primary" theme="primary"
                    id="btn-submit" />
            </div>
        </form>
    </div>
</x-adminlte-modal>

@push('js')
    <script>
            const campoRequired = "Por favor, preencha este campo";
            let validator = $('#form').validate({
                rules: {
                    nome_terceiro                 : "required",
                    descricao                     : "required",
                    localizacao_fisica_pais_estado: "required",
                    //id_ativo                      : "required",
                    //ativo_sis_doc                 : "required",
                    responsavel_interno_ativo     : "required",
                    tipo_servico_prestado         : "required",
                    status                        : "required",
                    importancia                   : "required",
                    site_terceiro                 : "required",
                    cnpj_terceiro                 : "required",
                    nome_contato_terceiro         : "required",
                    email_contato_terceiro        : {
                        required: true,
                        email: true
                    },
                    telefone_contato_terceiro   : "required",
                    responsavel_interno_terceiro: "required",
                },
                messages: {
                    nome_terceiro                 : campoRequired,
                    descricao                     : campoRequired,
                    localizacao_fisica_pais_estado: campoRequired,
                    //id_ativo                      : campoRequired,
                    //ativo_sis_doc                 : campoRequired,
                    responsavel_interno_ativo     : campoRequired,
                    tipo_servico_prestado         : campoRequired,
                    status                        : campoRequired,
                    importancia                   : campoRequired,
                    site_terceiro                 : campoRequired,
                    cnpj_terceiro                 : campoRequired,
                    nome_contato_terceiro         : campoRequired,
                    email_contato_terceiro        : {
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

            });
        
        $("#form").submit(function(e) {
            e.preventDefault();
            $(this).find('#cnpj_terceiro').unmask()
            $(this).find('#telefone_contato_terceiro').unmask()
            let formData = $(this).serialize();
            let url = "{{ route('empresas.terceiros.store', $empresa->id) }}";
            if(!validator.form()){
                return;
            }
            $.ajax({
                data   : formData,
                url    : url,
                type   : "POST",
                success: function(response) {
                    toastr.success(response.message);
                    $("#table5").DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(index, value) {
                        // console.error(value)
                        toastr.warning(value)
                    })
                },
            });
            $(this).find('#cnpj_terceiro').mask('00.000.000/0000-00')
            $(this).find('#telefone_contato_terceiro').mask('(00) 0000-00009')
            return;
        })
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("#telefone_contato_terceiro").mask('(00) 00000-0000');
            $("#cnpj_terceiro").mask('000.000.0000/0000-00');
        })
    </script> --}}
@endpush

@push('js')
<script>
    $("#cnpj_terceiro").on('keypress',function(){
        $(this).mask('00.000.000/0000-00')
    })
    $("#telefone_contato_terceiro").on('keypress',function(){
        $(this).mask('(00) 00000-0000')
    })
</script>
@endpush
