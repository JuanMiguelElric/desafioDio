@extends('adminlte::page')
@section('content_header')
<h1></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{$user->adminlte_image()}}" alt="User profile picture" style="height: 100px; width:100px;">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    {{-- <p class="text-muted text-center">Software Engineer</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                </div>

            </div>


            {{-- <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>

                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                    <p class="text-muted">Malibu, California</p>
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>

            </div> --}}

        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="#config-password" data-toggle="tab">Password</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @if(Auth::guard('avaliacao')->user())
                        @php($rota = "/estudante/profile")
                        @endif
                        @if(Auth::user())
                        @php($rota = "/profile")
                        @endif
                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal" method="POST" action="{{url($rota, $user->id)}}" id="quickForm" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome" value="{{$user->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$user->email}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="avatar" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-input-file id="avatar" name="avatar" label="" placeholder="Escolher foto..." disable-feedback accept="image/png, image/gif, image/jpeg, image/jpg" />
                                    </div>
                                    <span>@error('avatar')
                                        {{$errors->first('avatar')}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="terms" @if($user->terms)
                                                checked
                                                @endif
                                                > Eu concordo com os <a href="#">termos e condições</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Editar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="config-password">
                            <form class="form-horizontal" action="{{url($rota.'/'.$user->id.'/reset')}}" method="POST" id="formPassword" novalidate="novalidate">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-2 col-form-label">Senha Atual</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" class="form-control passwords" id="current_password" placeholder="Senha atual" value="{{old('current_password')}}" required>
                                        <span class="text-danger">{{$errors->first('current_password')}}</span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Nova Senha</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control passwords" id="password" placeholder="Informe uma senha de 8 caracteres" required>
                                        {{$errors->first('password')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar Senha</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password_confirmation" class="form-control passwords" id="password_confirmation" placeholder="Informe uma senha de 8 caracteres" required>
                                        {{$errors->first('password_confirmation')}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" form="formPassword" class="btn btn-danger">Editar Senha</button>
                                        <button id="showPassword" type="button" class="btn btn-primary">Ver senhas</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<x-footer />
@endsection
@push('js')
<script>
    $(function() {
        const btnShow = document.querySelector('#showPassword');
        btnShow.addEventListener('click', function() {
            inputsPassword = document.querySelectorAll('.passwords');
            inputsPassword.forEach(element => {
                if (element.type == 'password') {
                    element.type = 'text';
                } else {
                    element.type = 'password';
                }
            });
        });
    });
</script>
<script>
    $(function() {
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                name: {
                    required: true,
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                name: {
                    required: "Please provide a name",
                },
                terms: "Please accept our terms"
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
    });
</script>
<script>
    $(function() {
        $.validator.addMethod("validPassword", function(value, element) {
            return /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);

        }, "A senha deve atender aos critérios especificados.");

        $("#formPassword").validate({
            rules: {
                current_password: {
                    required: true,
                },
                password: {
                    required: true,
                    validPassword: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                current_password: {
                    required: "campo obrigatório",
                },
                password: {
                    required: "campo obrigatório",
                    validPassword: "A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número, um caractere especial e ter no mínimo 8 caracteres de comprimento."
                },
                password_confirmation: {
                    required: "campo obrigatório",
                    equalTo: "As senhas não coincidem."
                }
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


    });
</script>
@isset($message)
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: 10000
    });

    $(document).add(function() {
        Toast.fire({
            icon: 'success',
            title: "{{$message}}",
        })
    });
</script>
@endisset
@isset($error)
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: 10000
    });

    $(document).add(function() {
        Toast.fire({
            icon: 'error',
            title: "{{$error}}",
        })
    });
</script>
@endisset
@error('current_password')
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: 10000
    });

    $(document).add(function() {
        Toast.fire({
            icon: 'error',
            title: "{{$errors->first('current_password')}}",
        })
    });
</script>
@enderror
@endpush

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)