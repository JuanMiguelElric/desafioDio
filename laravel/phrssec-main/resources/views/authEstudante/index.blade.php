@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])
@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop
@php( $estudante_login_url = View::getSection('estudante/login_url') ?? config('adminlte.estudante_login_url', 'estudante/login') )
@php( $estudante_register_url = View::getSection('estudante/register_url') ?? config('adminlte.estudante_register_url', 'estudante/register') )
@php( $estudante_password_reset_url = View::getSection('estudante/password_reset_url') ?? config('adminlte.estudante_password_reset_url', 'estudante/password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $estudante_login_url = $estudante_login_url ? route($estudante_login_url) : '' )
    @php( $estudante_register_url = $estudante_register_url ? route($estudante_register_url) : '' )
    @php( $estudante_password_reset_url = $estudante_password_reset_url ? route($estudante_password_reset_url) : '' )
@else
    @php( $estudante_login_url = $estudante_login_url ? url($estudante_login_url) : '' )
    @php( $estudante_register_url = $estudante_register_url ? url($estudante_register_url) : '' )
    @php( $estudante_password_reset_url = $estudante_password_reset_url ? url($estudante_password_reset_url) : '' )
@endif

@section('auth_body')
    <form action="/estudante/login" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email')}}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    @if($estudante_password_reset_url)
        <p class="my-0">
            <a href="{{ $estudante_password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif

    {{-- Register link --}}
    @if($estudante_register_url)
        <p class="my-0">
            <a href="{{ $estudante_register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@stop
