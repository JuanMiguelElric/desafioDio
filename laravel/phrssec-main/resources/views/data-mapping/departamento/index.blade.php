@extends('adminlte::page')
@section('title', 'Departamentos')
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>Departamentos</h1>
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
    <div class="container-fluid">

        <x-adminlte-modal id="modalNovoDepartamento" title="Novo Departamento" theme="teal" icon="fas fa-bolt" size='lg'>
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form id="form">
                    @csrf
                    <input type="hidden" name="json" value="1">
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <x-adminlte-select id="empresas" name="empresa" label="Empresas">
                                <option value="" selected>Selecionar...</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div> --}}

                        <x-adminlte-select-bs id="empresas" name="empresa" label="Empresas" label-class="text-black"
                            igroup-size="md" data-title="Select an option..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                        </x-adminlte-select-bs>

                        <x-adminlte-select-bs id="areas" name="area" label="Areas" label-class="text-black"
                            igroup-size="md" data-title="Select an option..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                        </x-adminlte-select-bs>

                        <div class="form-group">
                            <x-adminlte-input label="Nome *" name="nome" type="text" placeholder="Recursos Humanos"
                                id="nome" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Responsável" name="responsavel" type="text" id="responsavel"
                                placeholder="Nome responsável" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Telefone" name="telefone" type="text" id="telefone"
                                placeholder="(00) 00000-0000" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="E-mail" id="email" name="email" type="email"
                                placeholder="exemplo@empresa.com" />
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <x-adminlte-button type="submit" data-toggle="modal" data-target="#modalNovaEmpresa"
                            label="Inserir departamento" class="btn btn-primary" theme="primary" id="btn-submit" />
                    </div>
                </form>
            </div>
        </x-adminlte-modal>

        <x-adminlte-button label="Novo Departamento" data-toggle="modal" data-target="#modalNovoDepartamento"
            class="bg-teal mb-2" id="nova-empresa" />
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Empresa e áreas relacionadas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="json" value="true">
                        {{-- <div class="form-group">
                            <x-adminlte-select id="empresa-get" name="empresa" label="Empresa">
                                <option value="" selected>selecionar</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div> --}}
                        <x-adminlte-select-bs id="empresa-get" name="empresa" label="Empresa" label-class="text-black"
                            igroup-size="md" data-title="Selecionar empresa..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                        </x-adminlte-select-bs>

                        <x-adminlte-select-bs id="areas-get" name="area" label="Áreas" label-class="text-black"
                            igroup-size="md" data-title="Selecionar área..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                        </x-adminlte-select-bs>
                        {{-- <div class="form-group">
                            <x-adminlte-select id="areas-get" name="area" label="Areas">
                                <option value="" selected>selecionar Area</option>
                            </x-adminlte-select>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <x-adminlte-card title="Departamentos" theme="dark" theme-mode="outline" class="elevation-3"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light"
                    collapsible>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Departamentos</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Departamento</th>
                                            <th>Responsável</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Criado</th>
                                            <th>Atualizado</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="departamentos">

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </x-adminlte-card>
            </div>
        </div>



    </div>
    <x-adminlte-modal id="modalMin" title="exclusão">
        <div>Tem certeza que quer excluir?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel" />
            <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
        </x-slot>
    </x-adminlte-modal>
    <x-footer />
@endsection
@push('js')
    <script src="{{ asset('resources/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#telefone").mask('(00) 00000-0000');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#form").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // console.log(formData)
                $.ajax({
                    type: 'POST',
                    url: '/departamentos',
                    data: formData,
                    success: function(response) {
                        // console.log(response)
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        // console.error(xhr.responseText)
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.warning(value)
                        })
                    }

                })
            });

        });
        $("#empresas").change(function() {
            var valorSelecionado = $(this).val();
            console.log(valorSelecionado)
            if (valorSelecionado == "") {
                $('#areas').empty()
                $('#areas').append(
                    `<option value="#">selecionar avaliação primeiro</option>`
                )
                $("#areas").selectpicker('refresh');
                return
            }
            // console.log(valorSelecionado);
            $.ajax({
                type: 'GET',
                url: '/areabuscaporid/' + valorSelecionado,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias
                    $('#areas').empty()
                    console.log(response)
                    $.each(response.areas, function(index, {
                        id,
                        nome
                    }) {
                        $('#areas').append(
                            `<option value="${id}">${nome}</option>`
                        )
                        $("#areas").selectpicker('refresh');
                    })
                    $('#btn-editar').addClass('d-none');


                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    // console.error(xhr.responseText);
                    toastr.warning(xhr.responseJSON.error)
                    $('#areas').empty()
                    $('#areas').append(
                        `<option value="#">${xhr.responseJSON.areas}</option>`
                    )
                    $("#areas").selectpicker('refresh');
                    $('#btn-editar').removeClass('d-none');
                }
            });
        });

        //tabela de departamentos
        $("#empresa-get").change(function() {
            var valorSelecionado = $(this).val();
            if (valorSelecionado == "") {
                $('#areas-get').empty()
                $('#areas-get').append(
                    `<option value="#">selecionar empresa primeiro</option>`
                )
                $("#areas-get").selectpicker('refresh');
                return
            }
            // console.log(valorSelecionado);
            $.ajax({
                type: 'GET',
                url: '/areabuscaporid/' + valorSelecionado,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias
                    $('#areas-get').empty()
                    $("#areas-get").selectpicker('refresh');
                    $.each(response.areas, function(index, {
                        id,
                        nome
                    }) {
                        $('#areas-get').append(
                            `<option value="${id}">${nome}</option>`
                        )
                        
                    })
                    $("#areas-get").selectpicker('refresh');
                    $('#btn-editar').addClass('d-none');


                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    // console.error(xhr.responseText);
                    toastr.warning(xhr.responseJSON.error)
                    $('#areas-get').empty()
                    $('#areas-get').append(
                        `<option value="#">${xhr.responseJSON.areas}</option>`
                    )
                    $("#areas-get").selectpicker('refresh');
                    $('#btn-editar').removeClass('d-none');
                }
            });
        });
    </script>

    <script>
        $("#areas-get").change(function() {
            var valorSelecionado = $(this).val();
            var textOption = $(this).find("option:selected").text()
            if (valorSelecionado == "") {
                $('#departamentos').empty()
                $('#departamentos').append(
                    `<tr>
                    <td colspan="6">
                    <p class="text-center">
                        SEM DADOS..    
                    </p>
                    </td>
                </tr>`
                )
                return
            }
            // console.log(valorSelecionado);
            $.ajax({
                type: 'GET',
                url: '/areadepartamentobuscaporid/' + valorSelecionado,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias
                    $('#departamentos').empty()
                    // console.log(response.departamentos)
                    toastr.success("Departamentos do(a) " + textOption)
                    $.each(response.departamentos, function(index, {
                        id,
                        nome,
                        responsavel,
                        telefone,
                        email,
                        criado,
                        atualizado,
                        acoes
                    }) {
                        $('#departamentos').append(
                            `<tr>
                                <td>${id}</td>
                                <td>${nome}</td>
                                <td>${responsavel}</td>
                                <td>${telefone}</td>
                                <td>${email}</td>
                                <td>${criado}</td>
                                <td>${atualizado}</td>
                                <td>${acoes}</td>
                            </tr>`
                        )
                    })
                    $('#btn-editar').addClass('d-none');


                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    console.error(xhr.responseJSON);
                    toastr.warning(xhr.responseJSON.message)
                    $('#departamentos').empty()
                    $('#departamentos').append(
                        `<option value="#">${xhr.responseJSON.message}</option>`
                    )
                    $('#btn-editar').removeClass('d-none');
                }
            });
        });
    </script>

    <script src="{{ asset('resources/js/requisicaoAjax.js') }}"></script>

    <script>
        $(document).on('click', '.excluir-dado', function() {
            let dadoId = $(this).data('dado-id');
            let element = $(this);
            let url = '{{ route('departamentos.destroy', ':dadoId') }}';
            let data = {
                '_token': '{{ csrf_token() }}'
            };
            url = url.replace(":dadoId", dadoId);
            confirmDelete(url, data, "DELETE", element, dadoId);

        })
    </script>
    <script>
        function confirmDelete(url, data, method, element, dadoId) {
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
                let excluiu = false;
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
                            element.parent().parent().parent().fadeOut('slow')
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            toastr.warning(xhr.responseJSON);
                            excluiu = false;
                        }
                    })
                }
                return excluiu;
            });
        }
    </script>
@endpush
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
@section('plugins.BootstrapSelect', true)
