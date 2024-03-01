@extends('adminlte::page')
@section('title', 'Areas da empresa')
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
@push('css')
    <style type="text/css">
        .editar:hover {
            background: #ced4da;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary mb-2" id="refresh">Atualizar</button>

        <x-adminlte-button label="Nova Area" data-toggle="modal" data-target="#modalNovaArea" class="bg-teal mb-2"
            id="nova-area" />
        <div class="row">
            <div class="col-md-4">
                <x-adminlte-card title="Empresas" theme="dark" theme-mode="outline" class="elevation-3"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light"
                    collapsible>
                    <form id="form">
                        @csrf
                        <!-- /.card-body -->
                        <div class="card-body">
                            <input type="hidden" name="json" value="false">
                            {{-- <div class="form-group">
                                <x-adminlte-select id="empresas" name="empresa" label="Empresas">
                                    <option value="" selected>Selecionar...</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div> --}}
                            <x-adminlte-select-bs name="empresas" label="Empresas" label-class="text-black"
                            igroup-size="md" data-title="Selecionar empresa..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                            {{-- <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-car-side"></i>
                                </div>
                            </x-slot> --}}
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                            {{-- <option data-icon="fa fa-fw fa-car">Car</option>
                            <option data-icon="fa fa-fw fa-motorcycle">Motorcycle</option> --}}
                        </x-adminlte-select-bs>
                        </div>
                        <div class="card-footer">
                            <!-- <x-adminlte-button type="submit" label="Gerar Avaliação" class="btn btn-primary" theme="primary" /> -->
                        </div>
                    </form>
                </x-adminlte-card>
            </div>
            <div class="col-md-8">
                <x-adminlte-card title="Areas" theme="dark" theme-mode="outline" class="elevation-3"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-ligth border-top rounded border-light"
                    collapsible>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Areas</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Area</th>
                                            <th>Status</th>
                                            <th>Criado em</th>
                                            <th>Departamentos</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="areas">

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </x-adminlte-card>
            </div>
        </div>


    </div>

    <x-adminlte-modal id="modalNovaArea" title="Nova Area" theme="teal" icon="fas fa-bolt" size='lg'>
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-inserir">
                @csrf
                <input type="hidden" name="json" value="1">
                <div class="card-body">
                    <div class="form-group">
                        {{-- <x-adminlte-select id="empresas" name="empresa" label="Empresas">
                            <option value="" selected>Selecionar...</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                        </x-adminlte-select> --}}
                        <x-adminlte-select-bs name="empresa" label="Empresas" label-class="text-black"
                            igroup-size="md" data-title="Selecionar empresa..." data-live-search
                            data-live-search-placeholder="procurar..." data-show-tick>
                            {{-- <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-car-side"></i>
                                </div>
                            </x-slot> --}}
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                            @endforeach
                            {{-- <option data-icon="fa fa-fw fa-car">Car</option>
                            <option data-icon="fa fa-fw fa-motorcycle">Motorcycle</option> --}}
                        </x-adminlte-select-bs>
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="Nome *" name="nome" type="text" placeholder="Operacional"
                            id="nome" value="Operacional" />
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <x-adminlte-button type="submit" data-toggle="modal" data-target="#modalNovaArea" label="Inserir Area"
                        class="btn btn-primary" theme="primary" id="btn-submit" />
                </div>
            </form>
        </div>
    </x-adminlte-modal>
    <x-adminlte-modal id="modalMin" title="exclusão">
        <div>Tem certeza que quer excluir?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal" id="cancel" />
            <x-adminlte-button class="mr-auto" theme="success" label="Accept" id="confirmation" />
        </x-slot>
    </x-adminlte-modal>
    <x-footer />
    <x-errors.erro-ajax />

@endsection

@push('js')
    <script>
        $("#empresas").change(function() {
            var valorSelecionado = $(this).val();
            if (valorSelecionado == "") {
                $('#areas').empty()
                $('#areas').append(
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
                url: '/areabuscaporid/' + valorSelecionado,
                success: function(response) {
                    // Lógica de sucesso
                    // Atualize a página ou faça outras ações necessárias
                    $('#areas').empty()
                    // console.log(response);
                    $.each(response.areas, function(index, {
                        id,
                        nome,
                        status,
                        created_at,
                        departamentos,
                        btns
                    }) {
                        $('#areas').append(
                            renderizaDepartamentos(id, nome, status, created_at,
                                departamentos, btns)
                        )
                    })



                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    // console.error(xhr.responseText);
                    toastr.warning(xhr.responseJSON.error)
                    $('#perguntas').empty()
                    $('#perguntas').append(
                        ` < option value = "#" > $ {
                                        xhr.responseJSON.areas
                                    } < /option>`
                    )
                }
            });
        });

        function renderizaDepartamentos(id, nome, status, created_at, departamentos, btns) {
            let tr = `<tr data-widget="expandable-table" aria-expanded="false">
            <td>${id}</td>
            <td>${nome}</td>
            <td>${status}</td>
            <td>${ created_at }</td>
            <td>${ departamentos.length }</td>
            <td>${ btns }</td>
        </tr>
        <tr class="expandable-body">
            <td colspan="6">
            <div class="table-responsive" style="display:none;" id="area-${id}">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">telefone</th>
                            <th scope="col">email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>`;
            $.each(departamentos, function(index, {
                id,
                nome,
                responsavel,
                telefone,
                email
            }) {
                tr += `<tr>
                    <th scope="row">${id}</th>
                    <td>${nome}</td>
                    <td>${responsavel}</td>
                    <td>${telefone}</td>
                    <td>${email}</td>
                    <td>${btn(id)}</td>
                </tr>`
            })
            tr += `</tbody>
                        </table>
                    </div>
                </td></tr>`;
            return tr;
        }

        function btn(id) {
            let btnEdit = `<a href="/departamentos/${id}/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>`;

            let btnDelete = `<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado-departamento" title="Delete" data-dado-id="${id}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>`;


            return `<nobr>${btnEdit + btnDelete}</nobr>`
        }
    </script>
    <script>
        $(document).on('click', '.excluir-dado', function() {
            let dadoId = $(this).data('dado-id');
            let element = $(this);
            let url = '{{ route('areas.destroy', ':dadoId') }}';
            let data = {
                '_token': '{{ csrf_token() }}'
            };
            url = url.replace(":dadoId", dadoId);
            // confirmDelete();
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
                            element.parent().parent().parent().parent().find("#area-" + dadoId)
                                .fadeOut('slow');
                            element.parent().parent().parent().remove();

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
    <script src="{{ asset('resources/js/requisicaoAjax.js') }}"></script>
    <script>
        $("#form-inserir").submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            console.log(data)
            requisicaoAjax("#form-inserir", "POST", "{{ route('areas.store') }}", data, "#");
        })
    </script>
    <script>
        $("#refresh").click(function() {
            location.reload()
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).on('click', '.excluir-dado-departamento', function() {
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
                            element.parent().parent().parent().parent().find("#area-" + dadoId)
                                .fadeOut('slow');
                            element.parent().parent().parent().remove();

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
@endpush

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
@section('plugins.BootstrapSelect', true)
