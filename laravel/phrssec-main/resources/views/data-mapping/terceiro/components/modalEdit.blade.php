<x-adminlte-modal id="modalEditarTerceiro" title="Editar Terceiro" theme="teal" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form-update">
            @csrf
            <input type="hidden" name="json" value="1">
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="card-body">
                <x-adminlte-input id="edit_nome_terceiro" name="edit_nome_terceiro"
                    placeholder="Nome do terceiro analisado" label="Nome do terceiro analisado" value="" />
                <x-adminlte-input id="edit_descricao" label="Descrição" name="edit_descricao" placeholder="Descrição"
                    value="" />
                <x-adminlte-input id="edit_localizacao_fisica_pais_estado" label="Localização física do armazenamento"
                    name="edit_localizacao_fisica_pais_estado"
                    placeholder="Indicação da localização física do armazenamento" value="" />
                {{-- <x-adminlte-input id="edit_id_ativo" label="Id do ativo" name="edit_id_ativo"
                    placeholder="Número de identificação do ativo (sistema ou documento) analisado" value="" /> --}}
                {{-- <x-adminlte-input id="edit_ativo_sis_doc" label="Ativo(Sistema / Documento)" name="edit_ativo_sis_doc"
                    placeholder="Nome do ativo (sistema ou documento) analisado" value="" /> --}}
                <x-adminlte-input id="edit_responsavel_interno_ativo" label="Responsável Interno pelo Ativo"
                    name="edit_responsavel_interno_ativo" placeholder="Responsável pelo terceiro dentro da empresa"
                    value="" />
                {{-- <x-adminlte-input name="responsavel_processo" placeholder="Responsável do Processo"  value="Teste Responsável pelo processo"/> --}}
                <x-adminlte-select id="edit_tipo_servico_prestado" name="edit_tipo_servico_prestado"
                    label="Tipo e serviço prestado">
                    <x-adminlte-options :options="[
                        'Consultoria' => 'Consultoria',
                        'Operação' => 'Operação',
                        'Regulatório' => 'Regulatório',
                        'Estratégico' => 'Estratégico',
                        'Tecnológico' => 'Tecnológico',
                    ]"
                        placeholder="Indicação de qual serviços é prestado pelo terceiro.." selected="" />
                </x-adminlte-select>
                <x-adminlte-select id="edit_status" name="edit_status" label="Status">
                    <x-adminlte-options :options="['Ativo' => 'Ativo', 'Inativo' => 'Inativo']"
                        placeholder="Status se a relação com o terceiro está ativa ou inativa.." selected="" />
                </x-adminlte-select>
                <x-adminlte-select id="edit_importancia" name="edit_importancia" label="Importância">
                    <x-adminlte-options :options="['Crítica' => 'Crítica', 'Alta' => 'Alta', 'Moderada' => 'Moderada', 'Baixa' => 'Baixa']"
                        placeholder="Grau de relevância da terceiro com o terceiro para a empresa.." selected="" />
                </x-adminlte-select>

                <x-adminlte-input id="edit_site_terceiro" label="Site do terceiro" name="edit_site_terceiro"
                    placeholder="Link do website do terceiro" value="" />
                <x-adminlte-input id="edit_cnpj_terceiro" label="CNPJ do Terceiro" name="edit_cnpj_terceiro"
                    placeholder="Nº do CNPJ do terceiro" value=""
                    pattern="[0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2}" maxlength="18" />
                <x-adminlte-input id="edit_nome_contato_terceiro" label="Nome do contato do terceiro"
                    name="edit_nome_contato_terceiro"
                    placeholder="Nome completo do representante ou ponto focal do terceiro" value="" />
                <x-adminlte-input id="edit_email_contato_terceiro" label="E-mail de contato do Terceiro"
                    name="edit_email_contato_terceiro" placeholder="E-mail do representante ou ponto focal do terceiro"
                    value="" />
                <x-adminlte-input id="edit_telefone_contato_terceiro" label="Telefone de contato do Terceiro"
                    name="edit_telefone_contato_terceiro"
                    placeholder="Número de telefone do representante ou ponto focal do terceiro" data-mask="(00) 0000-00009" />
                <x-adminlte-input id="edit_responsavel_interno_terceiro" label="Responsável Interno"
                    name="edit_responsavel_interno_terceiro" placeholder="Responsável pelo terceiro dentro da empresa"
                    value="" />

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar Terceiro" class="btn btn-primary" theme="primary"
                    id="btn-submit" data-toggle="modal" data-target="#modalEditarEmpresa" />
            </div>
        </form>
    </div>
</x-adminlte-modal>

@push('js')
    <!-- TRAZ ELEMENTO VIA AJAX E MODIFICA FORM-UPDATE -->
    <script>
        $(document).on('click', '.botao-edit', function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            var dadoId = $(this).attr('id');
            // console.log(dadoId)
            let url = "{{ route('terceiro.json', ':dadoId') }}";
            url = url.replace(':dadoId', dadoId)
            // console.log(url)
            // return
            var button = $(this);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Lógica de sucesso
                    // console.log(response.terceiro)
                    editaFormulario(response.terceiro);
                    return;
                    // Atualize a página ou faça outras ações necessárias
                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    $(document).add(function() {
                        Toast.fire({
                            icon: 'error',
                            title: error,
                        })
                    });
                    console.error(xhr.responseText);
                    return;
                }
            });

        });
    </script>
    <!-- FIM TRAZ ELEMENTO VIA AJAX E MODIFICA FORM-UPDATE -->

    <!-- EDITA O FORM UPDATE -->
    <script>
        function editaFormulario(terceiro) {
            // console.log(terceiro)
            $("#edit_id").val(terceiro.id);
            $("#edit_nome_terceiro").val(terceiro.nome_terceiro);
            $("#edit_descricao").val(terceiro.descricao);
            // $("#edit_responsavel_processo option[selected]").removeAttr('selected')
            // $("#edit_responsavel_processo option[value=" + terceiro.responsavel_processo + "]").attr('selected', "true");

            $("#edit_localizacao_fisica_pais_estado").val(terceiro.localizacao_fisica_pais_estado);
            //$("#edit_id_ativo").val(terceiro.id_ativo);


            //$("#edit_ativo_sis_doc").val(terceiro.ativo_sis_doc);
            $("#edit_responsavel_interno_ativo").val(terceiro.responsavel_interno_ativo);

            $("#edit_tipo_servico_prestado option[selected]").removeAttr('selected')
            $("#edit_tipo_servico_prestado option[value='" + terceiro.tipo_servico_prestado + "']").attr('selected',
                "true");

            $("#edit_status option[selected]").removeAttr('selected')
            $("#edit_status option[value='" + terceiro.status + "']").attr('selected',
                "true");

            $("#edit_importancia option[selected]").removeAttr('selected')
            $("#edit_importancia option[value='" + terceiro.importancia + "']").attr('selected',
                "true");

            $("#edit_site_terceiro").val(terceiro.site_terceiro);

            $("#edit_cnpj_terceiro").val(terceiro.cnpj_terceiro).trigger('input');
            $("#edit_nome_contato_terceiro").val(terceiro.nome_contato_terceiro);

            $("#edit_email_contato_terceiro").val(terceiro.email_contato_terceiro);
            $("#edit_telefone_contato_terceiro").val(terceiro.telefone_contato_terceiro);

            $("#edit_responsavel_interno_terceiro").val(terceiro.responsavel_interno_terceiro);

            return
        }
    </script>
    <!-- FIM EDITA O FORM UPDATE -->

    <script>
        $(document).ready(function() {
            $('#edit_cnpj_terceiro').mask('00.000.000/0000-00', {
                reverse: true
            });
        });
    </script>

    <script>
        let required = "Por favor, preencha esse campo";
        let validatorUpdate = $("#form-update").validate({
            rules: {
                edit_cnpj_terceiro: {
                    required: true,
                    minlength: 18,
                },
                edit_nome_terceiro                 : "required",
                edit_descricao                     : "required",
                edit_localizacao_fisica_pais_estado: "required",
                //edit_id_ativo                      : "required",
                //edit_ativo_sis_doc                 : "required",
                edit_responsavel_interno_ativo     : "required",
                edit_tipo_servico_prestado         : "required",
                edit_status                        : "required",
                edit_importancia                   : "required",
                edit_site_terceiro                 : "required",
                edit_nome_contato_terceiro         : "required",
                edit_email_contato_terceiro        : "required",
                edit_telefone_contato_terceiro     : "required",
                edit_responsavel_interno_terceiro  : "required",

            },
            messages: {
                edit_cnpj_terceiro                 : "Por favor, preencha este campo com um CNPJ válido.",
                edit_nome_terceiro                 : required,
                edit_descricao                     : required,
                edit_localizacao_fisica_pais_estado: required,
                //edit_id_ativo                      : required,
                //edit_ativo_sis_doc                 : required,
                edit_responsavel_interno_ativo     : required,
                edit_tipo_servico_prestado         : required,
                edit_status                        : required,
                edit_importancia                   : required,
                edit_site_terceiro                 : required,
                edit_nome_contato_terceiro         : required,
                edit_email_contato_terceiro        : required,
                edit_telefone_contato_terceiro     : required,
                edit_responsavel_interno_terceiro  : required,
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
            }

        });
    </script>

    <script>
        $("#form-update").submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let dadoId = $(this).serializeArray()[2].value;
            let url = "{{ route('terceiros.update', ':dadoId') }}";
            url = url.replace(':dadoId', dadoId);
            if (!validatorUpdate.form()) {
                return;
            }
            $.ajax({
                data: formData,
                url: url,
                type: "PUT",
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
        })
    </script>
@endpush
