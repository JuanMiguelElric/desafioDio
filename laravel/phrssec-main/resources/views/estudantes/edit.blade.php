@extends('adminlte::page')
@section('title',"Edição do estudante $estudante->name")
@section('content_header')
<h1></h1>
@endsection

@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar {{$estudante->name}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('estudantes.update',$estudante)}}" id="form">
            <div class="card-body">
                @csrf
                <input type="hidden" name="json" value="false" />
                <div class="form-group">
                    <x-adminlte-input id="name" label="Nome" name="name" type="text" placeholder="Nome Completo" value="{{$estudante->name}}" />
                    <x-adminlte-input id="email" label="E-mail" name="email" type="email" placeholder="example@email.com" value="{{$estudante->email}}" />
                    <x-adminlte-input id="password" label="Senha" name="password" type="text" placeholder="*********" />
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="#" class="btn btn-success" onclick="gerarSenha()">Gerar Senha</a>
                <x-adminlte-button type="submit" label="Editar {{$estudante->email}}" class="btn btn-primary" theme="primary" />
        </form>

    </div>
</div>

<x-footer />
@endsection
@push('js')
<script>
    $('#form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'PUT',
            url: "{{route('estudantes.update',$estudante)}}",
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
                window.location.href = "{{route('estudantes.index')}}";
                // console.log(response.card)
            },
            error: function(xhr, status, error) {
                // Lógica de erro
                if(xhr.responseJSON.message){
                    toastr.warning(xhr.responseJSON.message)
                }
                $.each(xhr.responseJSON.errors, function(key,value){
                    toastr.warning(value)
                })
            }
        });
    });
</script>
<script>
    function gerarSenha() {
        const upperCaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lowerCaseChars = "abcdefghijklmnopqrstuvwxyz";
        const specialChars = "!@#\$%\^&*()_-+=<>?";
        const numericChars = "0123456789";
        const allChars = upperCaseChars + lowerCaseChars + specialChars + numericChars;
        const comprimentoSenha = 16; // Você pode ajustar o comprimento da senha conforme necessário
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

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)