@extends('adminlte::page')
@section('title','Painel de usuarios')
@section('content_header')
<h1>Painel de Usuários</h1>
@endsection

@section('content')

@php
$heads = [
'ID',
'Name',
['label' => 'Email', 'width' => 30],
['label' => 'Actions', 'no-export' => true, 'width' => 10],
];

$config = [
"paging"=>true,
"search"=>[
'return'=>true
],
"ajax"=>[
'url'=>'/usuariosJson',
'dataSrc'=>"usuarios"
],
'data' => [
],
'order' => [[1, 'asc']],
"columns"=>[
["data"=> "id"],
["data"=> "name"],
["data"=> "email"],
["data"=> "btns"]

],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-modal id="modalPurple" title="Novo Usuário" theme="purple" icon="fas fa-bolt" size='lg'>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form id="form">
            @csrf
            <input type="hidden" name="json" value="1">
            <div class="card-body">
                <div class="form-group">
                    <x-adminlte-input label="E-mail" name="email" type="email" placeholder="example@hotmail.com" />
                </div>
                <div class="form-group">
                    <x-adminlte-input label="Nome" name="name" type="text" placeholder="Nome e Sobrenome" />
                </div>
                <div class="form-group">
                    <x-adminlte-input label="Password" name="password" type="text" placeholder="password" id="password" />
                    <a href="#" class="btn btn-primary" onclick="gerarSenha()">Gerar Senha</a>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button type="submit" id="enviar" label="Cadastrar novo usuário" class="btn btn-success" theme="primary" data-target="#modalPurple" data-toggle="modal" />
            </div>
        </form>
    </div>
</x-adminlte-modal>
<button class="btn btn-primary mb-2" id="refresh">Atualizar</button>
<x-adminlte-button label="Novo usuário" data-toggle="modal" data-target="#modalPurple" class="bg-purple mb-2" />
<x-adminlte-datatable id="table2" :heads="$heads" :config="$config" with-buttons />

<x-footer />
@endsection
@push('js')
<script>
    $(document).on('click', '.excluir-dado', function() {
        var dadoId = $(this).data('dado-id');
        var $button = $(this);
        if (confirm('Tem certeza de que deseja excluir este dado?')) {
            $.ajax({
                type: 'DELETE',
                url: '/usuarios/' + dadoId,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Lógica de sucesso

                    toastr.success(response.message)
                    // Atualize a página ou faça outras ações necessárias
                    $button.parent().parent().parent().remove()
                    $('#table2').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.warning(value)
                    });
                }
            });
        }
    });
    $('#form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/usuarios',
            data: formData,
            success: function(response) {
                // Lógica de sucesso
                // alert(response.message);
                // Atualize a página ou faça outras ações necessárias
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                $(document).add(function() {
                    Toast.fire({
                        icon: 'success',
                        title: response.message,
                    })
                });
                $('#table2').DataTable().ajax.reload();
                // console.log(response.card)
            },
            error: function(xhr, status, error) {
                // Lógica de erro
                console.log(xhr.responseJSON)
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.warning(value)
                });
            }
        });
    });
    $("#refresh").click(function() {
        $("#table2").DataTable().ajax.reload();
    })
</script>
<script>
    function gerarSenha() {
    const upperCaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowerCaseChars = "abcdefghijklmnopqrstuvwxyz";
    const specialChars = "!@#\$%\^&*()_-+=<>?";
    const numericChars = "0123456789";
    const allChars = upperCaseChars + lowerCaseChars + specialChars + numericChars;
    const comprimentoSenha = 8; // Você pode ajustar o comprimento da senha conforme necessário
    let senha = "";

    // Adicione pelo menos uma letra maiúscula, uma letra minúscula, um caractere especial e um número à senha
    senha += upperCaseChars.charAt(Math.floor(Math.random() * upperCaseChars.length));
    senha += lowerCaseChars.charAt(Math.floor(Math.random() * lowerCaseChars.length));
    senha += specialChars.charAt(Math.floor(Math.random() * specialChars.length));
    senha += numericChars.charAt(Math.floor(Math.random() * numericChars.length));

    for (let i = 4; i < comprimentoSenha; i++) {
        const randomIndex = Math.floor(Math.random() * allChars.length);
        senha += allChars.charAt(randomIndex);
    }

    // Embaralhe a senha para garantir que os caracteres estejam em ordem aleatória
    senha = senha.split('').sort(() => Math.random() - 0.5).join('');

    // Exibe a senha no campo de senha
    document.getElementById("password").value = senha;
}
</script>
@endpush
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)