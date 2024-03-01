@extends('adminlte::page')
@section('title','Dashboard')
@section('content_header')
@if($student->avaliacoes->isNotEmpty())
<div class="container">
    <h2>Avaliações</h2>
</div>
@else
<div class="container">
    <h2>Avaliações Concluídas</h2>
</div>
@endif
@endsection
@section('content')
@if($student->avaliacoes->isNotEmpty())
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        @foreach ($student->avaliacoes as $avaliacao)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <x-avaliacao :avaliacao="$avaliacao" />
        </div>
        @endforeach
    </div>
</div>
@endif
@if(!$studentConcluido->avaliacoes->isEmpty())
@if($student->avaliacoes->isNotEmpty())
<hr>
<div class="container">
    <h2>Avaliações Concluídas</h2>
</div>
@endif
<div class="container">
    <div class="row">
        @foreach ($studentConcluido->avaliacoes as $avaliacao)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <x-avaliacaoConcluida :avaliacao="$avaliacao"/>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection