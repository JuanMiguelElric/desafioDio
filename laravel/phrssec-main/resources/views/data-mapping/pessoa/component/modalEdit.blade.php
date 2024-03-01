<x-adminlte-modal id="modalEdit" title="Editar Pessoa" theme="teal" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form-update">
            @csrf
      
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="card-body">
                <x-adminlte-input id="edit_nome_completo" name="edit_nome_completo"
                    placeholder="Nome Completo" label="Nome completo" value="" />
                <x-adminlte-input id="edit_descricao" label="Nome Social" name="nome_social" placeholder="nome Social"
                    value="" />
               

           

                <x-adminlte-input id="edit_nome_social" label="Nome Social" name="edit_nome_social"
                    placeholder="Nome social " />
                <x-adminlte-input id="edit_cpf" label="CPF da pessoa" name="edit_cpf"
                    placeholder="Nº do CPF da pessoa" value=""
                    maxlength="14" />
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
                <x-adminlte-button type="submit" label="Editar Pessoa" class="btn btn-primary" theme="primary"
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
            let url = "{{ route('pessoa.json', ':dadoId') }}";
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
          
                    editaFormulario(response.pessoa);
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
        function editaFormulario(pessoa) {
            // console.log(terceiro)
            $("#edit_id").val(pessoa.id);
            $("#edit_nome_completo").val(pessoa.nome_completo);
            $("#edit_nome_social").val(pessoa.nome_social);

            
            
            $("#edit_cpf").val(pessoa.cpf).trigger('input');
            $("#edit_telefone").val(pessoa.telefone);

          
            $("#edit_whatsapp option[value='" + pessoa.whatsapp + "']").attr('selected',
                "true");



            $("#edit_email").val(pessoa.email);


            return
        }
    </script>
    <!-- FIM EDITA O FORM UPDATE -->

    <script>
        $(document).ready(function() {
            $('#edit_cpf').mask('000.000.000-00', {
                reverse: true
            });
        });
    </script>

    <script>
        let required = "Por favor, preencha esse campo";
        let validatorUpdate = $("#form-update").validate({
            rules: {
                edit_nome_completo :required,
                edit_nome_social : required,
                edit_cpf : required,
                edit_telefone : required,
                edit_whatsapp: required,
                edit_email : required,
                

            },
            messages: {
                          
                edit_nome_completo: required,
                edit_nome_social: required,
                edit_cpf:required,
                edit_telefone:required,
                edit_whatsapp:required,
                edit_email:required
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
            let url = "{{ route('pessoa.update', ':dadoId') }}";
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
