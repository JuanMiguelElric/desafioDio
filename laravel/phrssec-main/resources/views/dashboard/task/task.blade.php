<div class="container-fluid">
    <div class="row">
        <section class="col-lg-7">
            <div class="card" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        To Do List
                    </h3>
                    <div class="card-tools" id="paginationContainer">
                        {{-- <ul class="pagination pagination-sm"> --}}
                        {{-- <li class="page-item"><a href="#" class="page-link">«</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">»</a></li> --}}

                        {{-- </ul> --}}
                    </div>
                </div>

                <div class="card-body">
                    <ul class="todo-list ui-sortable" data-widget="todo-list" id="taskList">
                    </ul>
                </div>

                <div class="card-footer clearfix">
                    <x-todo.btn-add type="button" class="float-right" theme="primary" id="btn-add"
                        data-toggle="modal" data-target="#modalNovaTask" icon="fas fa-plus"> adicionar
                        tarefa</x-todo.btn-add>
                </div>
            </div>
        </section>
    </div>

</div>

<x-adminlte-modal id="modalNovaTask" title="Nova tarefa" theme="purple" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form-task">
            @csrf
            <input type="hidden" name="json" value="1">
            <div class="card-body">
                <x-adminlte-input label="Tarefa" name="title" type="text" placeholder="tarefa" id="tarefa" />

                <x-adminlte-input label="Tempo" name="time" type="text" placeholder="tempo" id="tempo" />
                <x-adminlte-select id="type" name="type">
                    <x-adminlte-options :options="[
                        'segundo(s)' => 'segundo(s)',
                        'minuto(s)' => 'minuto(s)',
                        'hora(s)' => 'hora(s)',
                        'dia(s)' => 'dia(s)',
                    ]" placeholder="Selecione uma opção..." />
                </x-adminlte-select>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" data-toggle="modal" data-target="#modalNovaTask"
                    icon="fas fa-lg fa-save" class="btn btn-primary" theme="purple" id="btn-submit" />
            </div>
        </form>
    </div>
</x-adminlte-modal>

<x-adminlte-modal id="modalEditaTask" title="Editar tarefa" theme="purple" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form-task-update">
            @csrf
            <input type="hidden" name="json" value="1">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="card-body">
                <x-adminlte-input label="Tarefa" name="edit_title" type="text" placeholder="tarefa"
                    id="edit_title" />

                <x-adminlte-input label="Tempo" name="edit_time" type="text" placeholder="tempo" id="edit_time" />
                <x-adminlte-select id="edit_type" name="edit_type">
                    <x-adminlte-options :options="[
                        'segundo(s)' => 'segundo(s)',
                        'minuto(s)' => 'minuto(s)',
                        'hora(s)' => 'hora(s)',
                        'dia(s)' => 'dia(s)',
                    ]" placeholder="Selecione uma opção..." />
                </x-adminlte-select>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit"
                    icon="fas fa-lg fa-save" class="btn btn-primary" theme="purple" id="btn-submit" />
            </div>
        </form>
    </div>
</x-adminlte-modal>

@push('js')
    <script>
        $(function() {
            $("#taskList").sortable();
        });
    </script>
@endpush

@push('js')
    <script>
        function updateTaskList(page) {
            let url = "{{ route('tasks.json') }}" + "?page=:page";
            url = url.replace(':page', page)
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Limpar a lista existente
                    $('#taskList').empty();

                    // Adicionar as novas tarefas à lista
                    response.tasks.data.forEach(function(task) {
                        let done = task.completed == 1 ? 'done' : '';
                        console.log(done)
                        if (done != false) {
                            $('#taskList').append(
                                `<x-todo.task-item completed="${done}" title="${task.title}" id="${task.id}" badge="danger" time="${task.time} ${task.type}"/>`
                            );
                            return;
                        }
                        $('#taskList').append(
                            `<x-todo.task-item completed="" title="${task.title}" id="${task.id}" badge="danger" time="${task.time} ${task.type}"/>`
                        );
                        return;
                    });

                    // Atualizar a navegação da página
                    $('#paginationContainer').html(response.paginationHtml);

                    // Adicionar listener de evento para as páginas
                    $('#paginationContainer').off('click', '.pagination a').on('click', '.pagination a',
                        function(e) {
                            e.preventDefault();
                            var nextPage = $(this).attr('href').split('page=')[1];
                            console.log(nextPage)
                            updateTaskList(nextPage);
                            return;
                        });
                    return
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição Ajax:', error);
                    return;
                },
            });
            return;
        }

        // Chamar a função inicialmente com a página 1
        updateTaskList(1);

        // Configurar a repetição a cada 10 segundos
        // setInterval(function() {
        //     // Recuperar o número da página atual
        //     var currentPage = $('#sortable').data('current-page');

        //     // Incrementar a página para a próxima
        //     var nextPage = currentPage ? currentPage + 1 : 2;

        //     // Chamar a função com a próxima página
        //     updateTaskList(nextPage);
        // }, 10000);
    </script>
@endpush

@push('js')
    <script>
        $("#form-task").submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{ route('tasks.store') }}",
                data: formData,
                success: function(success) {
                    console.log(success)
                    toastr.success(success.message);
                    updateTaskList(1);
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                    toastr.warning(xhr.responseJSON.message);
                }

            })
        })
    </script>
@endpush
@push('js')
    <script>
        $(document).on('click', '.todo-trash', function() {
            let dadoId = $(this).data('dado-id');
            let element = $(this)
            let url = "{{ route('tasks.destroy', ':dadoId') }}";
            url = url = url.replace(':dadoId', dadoId);
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    // console.log(response)
                    // element.parent().parent().parent().parent().remove();
                    element.parent().parent().fadeOut();
                    toastr.success(response.message)
                    updateTaskList(1)
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }

            })
            element.parent().parent().fadeOut();
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).on('click', '.checkIn', function() {
            let dadoId = $(this).val();
            let url = "{{ route('tasks.update.complete', ':dadoId') }}";
            url = url.replace(':dadoId', dadoId);
            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message)
                    updateTaskList(1)
                },
                error: function(xhr, status, error) {
                    toastr.warning(xhr.responseJSON.message)
                }
            });
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).on('click', '.todo-edit', function() {
            let dadoId = $(this).data('dado-id');
            let element = $(this)
            let url = "{{ route('tasks.edit', ':dadoId') }}";
            url = url = url.replace(':dadoId', dadoId);

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    // console.log(response)
                    // element.parent().parent().parent().parent().remove();
                    console.log(response)
                    $("#edit_title").val(response.task.title);
                    $("#edit_time").val(response.task.time);
                    $("#edit_type").val(response.task.type);
                    $("#edit_id").val(response.task.id);

                    toastr.success("dados retornados")
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    })
                }

            })
        })
    </script>
@endpush

@push('js')
    <script>
        $("#form-task-update").submit(function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let dadoId = $(this).serializeArray()[2].value;
            let url = "{{route('tasks.update',':dadoId')}}"
            url = url.replace(":dadoId", dadoId);
            $.ajax({
                type:"PUT",
                url: url,
                data: data,
                success:function(response){
                    toastr.success(response.message)
                    updateTaskList(1)
                },
                error: function(xhr, status, error){
                    toastr.warning(response.message)

                }
            })
        })
    </script>
@endpush
