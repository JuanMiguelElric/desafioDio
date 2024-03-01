<x-adminlte-modal id="modalEdit" title="Editar cargo" theme="teal" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form-update">
            @csrf
      
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="card-body">
                <x-adminlte-input id="edit_nome_do_cargo" name="edit_nome_do_cargo"
                    placeholder="Nome Completo" label="Nome completo" value="" />

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Editar cargo" class="btn btn-primary" theme="primary"
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
            let url = "{{ route('cargo.json', ':dadoId') }}";
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
          
                    editaFormulario(response.cargo);
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
        function editaFormulario(cargo) {
            // console.log(terceiro)
            $("#edit_id").val(cargo.id);
            $("#edit_nome_do_cargo").val(cargo.nome_do_cargo);


            return
        }
    </script>
    <!-- FIM EDITA O FORM UPDATE -->



    <script>
        let required = "Por favor, preencha esse campo";
        let validatorUpdate = $("#form-update").validate({
            rules: {
                edit_nome_do_cargo :required,
           
                

            },
            messages: {
                          
                edit_nome_do_cargo: required,
         
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
        function editaFormulario(cargo) {
            $("#edit_id").val(cargo.id);
            $("#edit_nome_do_cargo").val(cargo.nome_do_cargo);
        }
    </script>

    <script>
        $("#form-update").submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let dadoId = $("#edit_id").val(); // Corrigido para obter o ID do cargo
            let url = "{{ route('cargo.update', ':dadoId') }}";
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
                        toastr.warning(value)
                    })
                },
            });
        })
    </script>

@endpush
