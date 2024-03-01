<x-adminlte-modal id="modalAddTerceiro" title="Adicionar pessoa" theme="teal" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            @csrf
            <input type="hidden" name="json" value="1">
            <div class="card-body">
                <x-adminlte-input name="nome_completo" placeholder="Nome do terceiro analisado"
                    label="Nome do terceiro analisado" value="Teste nome do Terceiro" />
                <x-adminlte-input name="nome_social" placeholder="Descrição" label="Descrição"
                    value="Teste nome do Terceiro" />


                <x-adminlte-select name="status" label="Status">
                    <x-adminlte-options :options="[
                        'Ativo' => 'Ativo',
                        'Inativo' => 'Inativo',
                    ]" placeholder="Selecione o status..." />
                </x-adminlte-select>


                <x-adminlte-input name="cpf" placeholder="cpf da pessoa" label="cpf da pessoa"
                    value="" data-mask="000.000.000-00"/>
               
                <x-adminlte-input name="email" placeholder="Email para contato da pessoa"
                    label="Email para contato da pessoa" value="example@example.com" />

                <x-adminlte-input name="telefone" placeholder="Telelfone para contato da pessoa"
                    label="Telefone para contato da pessoa" value="(13) 11111-1111" data-mask="(00) 00000-0000"/>



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
                    nome_completo                 : "required",
                    nome_social                     : "required",
                    cpf                 : "required",
                    nome_contato_terceiro         : "required",
                    email        : {
                        required: true,
                        email: true
                    },
                    telefone   : "required",
                    responsavel_interno_terceiro: "required",
                },
                messages: {
                    nome_completo                 : campoRequired,
                    nome_social                     : campoRequired,
                    cpf                 : campoRequired,
                    email        : {
                        required: campoRequired,
                        email: "Por favor, insira um endereço de e-mail válido"
                    },
                    telefone: campoRequired,

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
            $(this).find('#cpf').unmask()
            $(this).find('#telefone').unmask()
            let formData = $(this).serialize();
            let url = "{{ route('empresas.pessoa.store', $empresa->id) }}";
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
            $(this).find('#cpf').mask('00.000.000/0000-00')
            $(this).find('#telefone').mask('(00) 0000-00009')
            return;
        })
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("#telefone").mask('(00) 00000-0000');
            $("#cnpj").mask('000.000.000-00');
        })
    </script> --}}
@endpush

@push('js')
<script>
    $("#cpf").on('keypress',function(){
        $(this).mask('00.000.000/0000-00')
    })
    $("#telefone").on('keypress',function(){
        $(this).mask('(00) 00000-0000')
    })
</script>
@endpush
