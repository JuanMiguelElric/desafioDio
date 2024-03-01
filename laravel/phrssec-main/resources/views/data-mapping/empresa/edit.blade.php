@extends('adminlte::page')
@section('title', $empresa->nome)
@section('content_header')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Editar {{ $empresa->nome }}</h1>
            </div>
            @isset($breadcrumb)
                <div class="col-sm-6">
                    <x-breadcrumb :breadcrumb="$breadcrumb" />
                </div>
            @endisset
        </div>
    </div>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $empresa->nome }}</h3>
                    </div>


                    <form action="{{ route('empresas.update', $empresa->id) }}" id="form-update" method="POST">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <x-adminlte-input label="Nome" name="edit_nome" class="is-valid" type="text"
                                placeholder="nome da empresa" id="nome" value="{!! $empresa->nome !!}" />
                            <x-adminlte-input label="CNPJ" name="edit_cnpj" class="is-valid" type="text"
                                placeholder="00.000.000/0000-00" id="cnpj" value="{{ $empresa->cnpj }}" />
                            <x-adminlte-input label="Telefone" name="edit_telefone" class="is-valid" type="text"
                                placeholder="(00) 00000-0000" id="telefone" value="{{ $empresa->telefone }}" />
                            <x-adminlte-input label="E-mail" name="edit_email" class="is-valid" type="email"
                                placeholder="example@example.com" id="email" value="{{ $empresa->email }}" />
                            <div class="form-group">
                                <x-adminlte-button type="button" label="adicionar filial" class="btn btn-primary"
                                    theme="primary" id="btnAddFilial" />
                            </div>
                            <div id="filiais">
                                @if ($errors->has('edit_filial.*.cnpj'))
                                    {{-- @foreach ($errors->get('edit_filial.*.cnpj') as $erro) --}}
                                        <div class="alert alert-warning" role="alert">CNPJ da Inválido</div>
                                    {{-- @endforeach --}}
                                @endif
                                @if ($empresa->has('filiais'))
                                    @foreach ($empresa->filiais as $filial)
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex">
                                                <input type="hidden" name="edit_filial[{{ $loop->index }}][id]"
                                                    value="{{ $filial->id }}">
                                                <x-adminlte-input id="nomeFilial{{ $loop->index }}"
                                                    label="Nome da filial ou matriz"
                                                    name="edit_filial[{{ $loop->index }}][nome]" type="text"
                                                    placeholder="Phrssec filial" value="{{ $filial->nome }}"
                                                    class="mr-2" />
                                                <x-adminlte-input id="cnpjFilial{{ $loop->index }}"
                                                    label="CNPJ da filial ou matriz"
                                                    name="edit_filial[{{ $loop->index }}][cnpj]" type="text"
                                                    placeholder="55.458.751/2547-86" value="{{ $filial->cnpj }}"
                                                    class="cnpjs" data-mask="00.000.000/0000-00" />
                                            </div>
                                            <x-adminlte-button label="remover" class="bg-danger mb-3 btn-delete-filial"
                                                data-dado-id="{{ $filial->id }}" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <x-adminlte-select name="edit_status">
                                    <x-adminlte-options :options="['Inativo', 'Ativo']" selected="{{ $empresa->status }}"
                                        id="status" />
                                </x-adminlte-select>
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observações</label>
                                <x-adminlte-textarea name="edit_observacao" class="is-valid"
                                    placeholder="Insira uma observação..." id="observacao" rows="5">
                                    {{ $empresa->observacao }}
                                </x-adminlte-textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                    <x-adminlte-modal id="modalMin" title="exclusão">
                        <div>Tem certeza que quer excluir?</div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel" />
                            <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
                        </x-slot>
                    </x-adminlte-modal>
                </div>
            </div>
        </div>

    </div>

    {{-- Setup data for datatables --}}
    @if (session('message'))
        @push('js')
            <script>
                let Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: true,
                    timer: 6000,
                });
                Toast.fire({
                    icon: "{{ session('message')['type'] }}",
                    title: "{{ session('message')['message'] }}",
                });
            </script>
        @endpush
    @endif
    <x-footer />
@endsection

@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            let inicioContador = {{ $empresa->filiais->count() }}
            let contadorFilial = inicioContador + 1;

            // Adiciona um ouvinte de evento ao switch
            $('#btnAddFilial').on('click', function() {
                var idNome = 'nomeFilial' + contadorFilial;
                var idCnpj = 'cnpjFilial' + contadorFilial;
                $("#filiais").append(
                    `<div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex">
                                <input type="hidden" name="edit_filial[${contadorFilial-1}][id]" value="-1">
                                <x-adminlte-input id="${idNome}" label="Nome da filial ou matriz" name="edit_filial[${contadorFilial-1}][nome]" type="text"
                                placeholder="Phrssec filial" value="teste Filial" class="mr-2" />
                                <x-adminlte-input id="${idCnpj}" label="CNPJ da filial ou matriz" name="edit_filial[${contadorFilial-1}][cnpj]" type="text"
                                placeholder="55.458.751/2547-86" value="55.458.751/2547-86" data-mask="00.000.000/0000-00" class="cnpjs" />
                            </div>
                            <x-adminlte-button label="remover" class="bg-danger remover-filial mb-3" />
                        </div>`
                )
                // Adicione aqui o código a ser executado quando o switch está ligado
                contadorFilial++;
                // console.log(contadorFilial)
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
    {{-- <script>
        $(document).ready(function(){
            let cnpjs = $(this).find('.cnpjs');
            console.log(cnpjs)
            cnpjs.each(function(index,element){
                $(element).mask('00.000.000/0000-00')
            })
        })
    </script> --}}
@endpush
@push('js')
    <script>
        $(document).on("submit", function(e) {
            let filialCnpjs = $(this).find('.cnpjs');
            let telefone = $(this).find('#telefone');
            let cnpj = $(this).find('#cnpj');
            telefone.unmask();
            cnpj.unmask();
            filialCnpjs.each(function(index, element) {
                $(element).unmask();
            })
        });
    </script>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
            $("#telefone").mask('(00) 00000-0000');
        })
    </script>

    <!-- DELETE FILIAL AJAX -->
    <script>
        $(document).on('click', '.btn-delete-filial', function() {
            var Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            let dadoId = $(this).data('dado-id');
            let url = '{{ route('filiais.destroy', ':dadoId') }}';
            let btnRemover = $(this);
            let data = {
                '_token': '{{ csrf_token() }}'
            };
            url = url.replace(":dadoId", dadoId);
            $("#modalMin").modal('show');
            $('#cancel').click(function() {
                $('#modalMin').modal('hide')
                return
            })
            $('#confirmation').off('click').on('click', function() {
                $.ajax({
                    data: data,
                    url: url,
                    type: "DELETE",
                    success: function(response) {
                        $('#modalMin').modal('hide')
                        Toast.fire({
                            icon: response.type,
                            title: response.message,
                        });
                        btnRemover.parent().remove();
                    },
                    error: function(xhr, status, error) {
                        Toast.fire({
                            icon: response.type,
                            title: response.message,
                        });
                    }
                });
                return
            })
        })
    </script>
    <!-- FIM DELETE FILIAL AJAX -->

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
                edit_status: "required",
                edit_observacao: "required",
            },
            messages: {
                edit_nome: {
                    required: "campo obrigatório",
                },
                edit_cnpj: {
                    required: "campo obrigatório",
                    number: "apenas números"
                },
                edit_email: {
                    required: "campo obrigatório",
                    email: "apenas email valido"
                },
                edit_telefone: {
                    required: "campo obrigatório",
                    number: "apenas números"
                },
                edit_status: "campo obrigatório",
                edit_observacao: "campo obrigatório"
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            }
        });
    </script>
    <!-- VALIDATOR UPDATE -->
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
