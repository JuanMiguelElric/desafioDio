@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="0" text="User Registrations" icon="fas fa-user-plus text-teal" theme="primary"
                    url="{{ route('estudantes.index') }}" url-text="Ver todos os estudantes" id="usersUpdate" />
            </div>
           

        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function() {
            
                let sBox = new _AdminLTE_SmallBox('usersUpdate');

                let updateBox = () => {
                    // Stop loading animation.
                    sBox.toggleLoading();

                    // Update data using Ajax.
                    $.ajax({
                        url: "/indexjsoncount",
                        method: "GET", // ou "POST" dependendo do seu servidor
                        dataType: "json",
                        success: function(response) {
                            // Processar a resposta e atualizar o SmallBox conforme necessário.
                            // console.log(response)
                            let title = response.estudantes
                            let text = 'Estudantes registrados';
                            let icon = 'fas fa-user-plus text-teal';
                            let url = "{{ route('estudantes.index') }}";
                            let data = {
                                text,
                                icon,
                                url,
                                title
                            };
                            // console.log(data)
                            sBox.update(data);
                        },
                        error: function(error) {
                            // Lida com erros, se houver algum.
                            console.error("Erro na requisição Ajax:", error);
                        },
                        complete: function() {
                            // Executado após o sucesso ou falha da requisição Ajax.
                            setTimeout(startUpdateProcedure, 2000);
                        }
                    });
                };

                let startUpdateProcedure = () => {
                    // Simulate loading procedure.
                    sBox.toggleLoading();

                    // Wait and update the data.
                    setTimeout(updateBox, 30000);
                };

                updateBox();
            });
        </script>
    @endpush
    
    @include('dashboard.task.task')


    
    @push('js')
    <script>
        
    </script>
    @endpush
@endsection
@section('plugins.ICheckBootstrap',true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)
