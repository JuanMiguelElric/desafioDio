@extends('adminlte::page')
@section('title', 'Painel de empresas')
@section('content_header')
    <!-- <h1>Painel de Estudantes</h1> -->
@endsection

@section('content')

    <x-adminlte-modal id="modalNovaEmpresa" title="Nova Empresa" theme="teal" icon="fas fa-bolt" size='lg'>
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form">
                @csrf
                <input type="hidden" name="json" value="1">
                <div class="card-body">
                    <div class="form-group">
                        <x-adminlte-input label="Nome *" name="nome" type="text" placeholder="Phrssec" id="nome"
                             />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="CNPJ" name="cnpj" type="text" id="cnpj" placeholder="CNPJ"
                             data-mask="00.000.000/0000-00" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="Telefone" name="telefone" type="text" id="telefone"
                            placeholder="(00) 00000-0000"  />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="E-mail" id="email" name="email" type="email"
                            placeholder="exemplo@empresa.com"  />
                    </div>
                    <div class="form-group">
                        <x-adminlte-button type="button" label="adicionar filial" class="btn btn-primary" theme="primary"
                            id="btnAddFilial" />
                    </div>
                    <div id="filiais">

                    </div>
                    <div class="form-group">
                        <label for="observacao">Observações</label>
                        <x-adminlte-textarea name="observacao" placeholder="Insira uma observação..." id="observacao" />
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <x-adminlte-button type="submit" data-toggle="modal" data-target="#modalNovaEmpresa"
                        label="Inserir Empresa" class="btn btn-primary" theme="primary" id="btn-submit" />
                </div>
            </form>
        </div>
    </x-adminlte-modal>

    <button class="btn btn-primary mb-2" id="refresh">Atualizar</button>
    <x-adminlte-button label="Nova Empresa" data-toggle="modal" data-target="#modalNovaEmpresa" class="bg-teal mb-2"
        id="nova-empresa" />

    @php
        $heads = [['label' => 'ID', 'width' => 1], 'Nome', 'CNPJ', 'Telefone', 'Status', 'Criado', 'Terceiros', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];

        $config = [
            'ajax' => [
                'url' => '/empresasJson',
                'dataSrc' => 'empresas',
            ],
            'data' => [],
            'autofill' => true,
            'order' => [[0,'desc']],
            'columns' => [['data' => 'id'], ['data' => 'nome'], ['data' => 'cnpj', 'class' => 'cnpjs'], ['data' => 'telefone'], ['data' => 'status'], ['data' => 'created_at'], ['data' => 'btn_terceiros'], ['data' => 'btns']],
        ];
    @endphp
    <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable />

    <x-adminlte-modal id="modalMin" title="exclusão" >
        <div>Tem certeza que quer excluir?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancel" />
            <x-adminlte-button class="mr-auto" theme="success" label="Confirmar" id="confirmation" />
        </x-slot>
    </x-adminlte-modal>

    <x-footer />
@endsection

@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {

            let contadorFilial = 1;
            $(document).on('click', '.botao-edit', function() {
                contadorFilial = 1;
                console.log('Contador: ' + contadorFilial)
            })
            // Adiciona um ouvinte de evento ao switch
            $('#edit_btnAddFilial').on('click', function() {
                var idNome = 'nomeFilial' + contadorFilial;
                var idCnpj = 'cnpjFilial' + contadorFilial;
                $("#edit_filiais").append(
                    `<div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex">
                                <x-adminlte-input id="${idNome}" label="Nome da filial ou matriz" name="filial[${contadorFilial-1}][nome]" type="text"
                                placeholder="Phrssec filial"  class="mr-2" />
                                <x-adminlte-input id="${idCnpj}" label="CNPJ da filial ou matriz" name="filial[${contadorFilial-1}][cnpj]" type="text"
                                placeholder="00.000.000/0000-00" data-mask="00.000.000/0000-00"  />
                            </div>
                            <x-adminlte-button label="remover" class="bg-danger remover-filial mb-3" />
                        </div>`
                )
                // Adicione aqui o código a ser executado quando o switch está ligado
                contadorFilial++;
                console.log(contadorFilial)
                $(`#${idCnpj}`).mask('00.000.000/0000-00', {
                    reverse: true
                });
            });

        });
    </script>

    <script>
        $(document).on("click", ".remover-filial", function() {
            $(this).parent().remove();
        });
    </script>
@endpush
{{-- INSERE FILIAIS NO EDIT --}}
@push('js')
    <script>
        $(document).ready(function() {

            let contadorFilial = 1;
            $("#edit-empresa").click(function() {
                contadorFilial = 1;
                console.log('cliquei')
            })
            // Adiciona um ouvinte de evento ao switch
            $('#btnAddFilial').on('click', function() {
                var idNome = 'nomeFilial' + contadorFilial;
                var idCnpj = 'cnpjFilial' + contadorFilial;
                $("#filiais").append(
                    `<div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex">
                                <x-adminlte-input id="${idNome}" label="Nome da filial ou matriz" name="filial[${contadorFilial-1}][nome]" type="text"
                                placeholder="Phrssec filial" class="mr-2" />
                                <x-adminlte-input id="${idCnpj}" label="CNPJ da filial ou matriz" name="filial[${contadorFilial-1}][cnpj]" type="text"
                                placeholder="00.000.000/0000-00" data-mask="00.000.000/0000-00"  />
                            </div>
                            <x-adminlte-button label="remover" class="bg-danger remover-filial mb-3" />
                        </div>`
                )
                // Adicione aqui o código a ser executado quando o switch está ligado
                contadorFilial++;
                console.log(contadorFilial)
                $(`#${idCnpj}`).mask('00.000.000/0000-00', {
                    reverse: true
                });
            });

        });
    </script>

    <script>
        $(document).on("click", ".remover-filial", function() {
            $(this).parent().remove();
        });
    </script>
@endpush
{{-- FIM EDIT EMPRESA --}}
@push('js')
    <script>
        $('#refresh').click(function() {
            $('#table5').DataTable().ajax.reload();
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
            $('#edit_cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
            $("#telefone").mask('(00) 00000-0000');
            $("#edit_telefone").mask('(00) 00000-0000');
        })
    </script>

    <x-errors.erro-ajax />

    <!-- VALIDATOR FORM -->
    <script>
        let validator = $("#form").validate({
            rules: {
                nome: {
                    required: true,
                },
                cnpj: {
                    required: true,
                    minlength: 14
                },
                email: {
                    required: true,
                    email: true,
                },
                telefone: {
                    required: true,
                    minlength: 11
                },
            },
            messages: {
                nome: {
                    required: 'campo obrigatório',
                },
                cnpj: {
                    required: 'campo obrigatório',
                    number: "apenas números"
                },
                email: {
                    required: 'campo obrigatório',
                    email: 'apenas email valido'
                },
                telefone: {
                    required: 'campo obrigatório',
                    number: "apenas números"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>
    <!-- FIM VALIDATOR FORM -->

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
            // return
            var button = $(this);
            $.ajax({
                type: 'GET',
                url: '/buscaporid/' + dadoId,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Lógica de sucesso
                    // console.log(response.empresa)
                    editaFormulario(response.empresa);
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
        function editaFormulario(empresa) {
            $("#edit_id").val(empresa.id);
            $("#edit_nome").val(empresa.nome);
            $("#edit_cnpj").val(empresa.cnpj);
            $("#edit_telefone").val(empresa.telefone);
            $("#edit_email").val(empresa.email);
            $("#edit_observacao").val(empresa.observacao);
            $("#status option[selected]").removeAttr('selected')
            $("#status option[value=" + empresa.status + "]").attr('selected', "true");
            // $("#btn-submit").text("Editar empresa")
            // $('#form').attr('id', 'form-update');
            return
        }
    </script>
    <!-- FIM EDITA O FORM UPDATE -->

    <script src="{{ asset('resources/js/requisicaoAjax.js') }}"></script>

    <!-- POST AJAX -->
    <script>

        $("#form").submit(function(e) {
            e.preventDefault();
            // $(this).find('#cnpj').unmask();
            if (!validator.form()) {
                return;
            }
            data = $(this).serialize();
            url = "{{ route('empresas.store') }}";
            requisicaoAjax('#form', 'POST', url, data, "#table5")
            $("#filiais").empty();
            // $(this).find('#cnpj').mask('00.000.000/0000-00');
            return;
        })
    </script>
    <!-- FIM POST AJAX -->

    <!-- DELETE AJAX -->
    <script>
        $(document).on('click', '.btn-delete', function() {
            let dadoId = $(this).data('dado-id');
            let url = '{{ route('empresas.destroy', ':dadoId') }}';
            let data = {
                '_token': '{{ csrf_token() }}'
            };
            url = url.replace(":dadoId", dadoId);
            // confirmDelete();
           confirmDelete(url, data, "DELETE")

        })
    </script>
    <script>
        function confirmDelete(url, data, method) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você realmente deseja excluir este item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: method,
                        url: url,
                        data: data,
                        success: function(response) {
                            Swal.fire(
                                'Excluído!',
                                response.message,
                                'success'
                            );
                            $('#table5').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            toastr.warning(xhr.responseJSON);
                        }
                    })
                }
                return;
            });
        }
    </script>
    <!-- FIM DELETE AJAX -->

    <!-- VALIDATOR UPDATE -->
    <script>
        let validator_edit = $("#form-update").validate({
            rules: {
                edit_nome: {
                    required: true,
                },
                edit_cnpj: {
                    required: true,
                    minlength: 18
                },
                edit_email: {
                    required: true,
                    email: true,
                },
                edit_telefone: {
                    required: true,
                    minlength: 14
                },
            },
            messages: {
                edit_nome: {
                    required: 'campo obrigatório',
                },
                edit_cnpj: {
                    required: 'campo obrigatório',
                    number: "apenas números"
                },
                edit_email: {
                    required: 'campo obrigatório',
                    email: 'apenas email valido'
                },
                edit_telefone: {
                    required: 'campo obrigatório',
                    number: "apenas números"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>
    <!-- VALIDATOR UPDATE -->
    <!-- UPDATE -->
    <script>
        $("#form-update").submit(function(e) {
            $("#modalEditarEmpresa").modal('hide')
            e.preventDefault()
            dadoId = $(this).serializeArray()[2].value;
            data = $(this).serialize();
            // dadoId = $(this);
            url = '{{ route('empresas.update', ':dadoId') }}';
            url = url.replace(':dadoId', dadoId);
            // console.log(url);
            // console.log(data);
            if (!validator_edit.form()) {
                return;
            }
            if (requisicaoAjax("#form-update", 'PUT', url, data, "#table5")) {}
            return;
        });
    </script>
    <!-- FIM UPDATE -->
@endpush

@push('js')
<script>
    $(document).ready(function(){
        $("#cnpj").on('keypress', function(){
            $(this).mask('00.000.000/0000-00')
        })
    })
</script>
@endpush

@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
