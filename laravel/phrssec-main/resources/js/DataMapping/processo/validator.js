$(document).ready(function () {
    $("#form").validate({
        rules: {
            edit_nome_processo: "required",
            edit_descricao: "required",
            edit_responsavel_processo: "required",
            edit_forma_de_coleta_dos_dados: "required",
            edit_id_coleta_ativos_ou_terceiros: "required",
            edit_tipo_armazenamento: "required",
            edit_id_de_armazenamento_ativo: "required",
            edit_nome_sistema_de_armazenamento: "required",
            edit_matriz_ou_filial_da_empresa: "required",
            edit_departamento: "required",
            edit_id_terceiro: "required",
            edit_nome_terceiro: "required",
            edit_localizacao_armazenamento_fisica_pais_estado: "required",
            edit_dados_pessoais_coletados: "required",
            edit_volume_de_dados_pessoais: "required",
            edit_tratamento_realizado: "required",
            edit_departamento_com_acesso_dados: "required",
            edit_finalidade_id: "required",
            edit_titular_de_dados: "required",
            edit_prazo_de_retencao: "required",
            edit_base_legal: "required",
            edit_base_legal_obs: "required",
            edit_responsavel_interno: "required",
            edit_responsavel_interno_telefone: "required",
            edit_responsavel_interno_email: {
                required: true,
                email: true
            }
        },
        messages: {
            edit_nome_processo: "Por favor, preencha este campo",
            edit_descricao: "Por favor, preencha este campo",
            edit_responsavel_processo: "Por favor, preencha este campo",
            edit_forma_de_coleta_dos_dados: "Por favor, preencha este campo",
            edit_id_coleta_ativos_ou_terceiros: "Por favor, preencha este campo",
            edit_tipo_armazenamento: "Por favor, preencha este campo",
            edit_id_de_armazenamento_ativo: "Por favor, preencha este campo",
            edit_nome_sistema_de_armazenamento: "Por favor, preencha este campo",
            edit_matriz_ou_filial_da_empresa: "Por favor, preencha este campo",
            edit_departamento: "Por favor, preencha este campo",
            edit_id_terceiro: "Por favor, preencha este campo",
            edit_nome_terceiro: "Por favor, preencha este campo",
            edit_localizacao_armazenamento_fisica_pais_estado: "Por favor, preencha este campo",
            edit_dados_pessoais_coletados: "Por favor, preencha este campo",
            edit_volume_de_dados_pessoais: "Por favor, preencha este campo",
            edit_tratamento_realizado: "Por favor, preencha este campo",
            edit_departamento_com_acesso_dados: "Por favor, preencha este campo",
            edit_finalidade_id: "Por favor, preencha este campo",
            edit_titular_de_dados: "Por favor, preencha este campo",
            edit_prazo_de_retencao: "Por favor, preencha este campo",
            edit_base_legal: "Por favor, preencha este campo",
            edit_base_legal_obs: "Por favor, preencha este campo",
            edit_responsavel_interno: "Por favor, preencha este campo",
            edit_responsavel_interno_telefone: "Por favor, preencha este campo",
            edit_responsavel_interno_email: {
                required: "Por favor, preencha este campo",
                email: "Por favor, insira um endereço de e-mail válido"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-valid');
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        },
        submitHandler: function (form) {
            // Este bloco é executado quando o formulário é validado com sucesso
            // Você pode adicionar código aqui para enviar o formulário, se necessário
            form.submit();
        }

    });
});