@extends('adminlte::page')
@section('title',"Avaliação $avaliacao->titulo" )
@section('content_header')
@endsection
@section('content')
<div class="py-4"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detalhes da avaliação</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">

                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Estudantes cadastrados</span>
                                <span class="info-box-number text-center text-muted mb-0">{{$avaliacao->students_count}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Perguntas</span>
                                <span class="info-box-number text-center text-muted mb-0">{{$avaliacao->perguntas_count}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Estudantes que concluiram</span>
                                <span class="info-box-number text-center text-muted mb-0">{{$avaliacao->students_concluido}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if($avaliacao->students_count == 0)
                <h4>0 alunos cadastrados no momento</h4>
                @else
                <h4>Estudantes cadastrados recentemente</h4>
                @endif
                <div class="row">
                    @foreach($avaliacao_estudantes as $student)
                    <div class="col-12">

                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{asset(Storage::url($student->students_photo))}}" alt="user image">
                                <span class="username">
                                    <a href="#">{{$student->students_name}}</a>
                                </span>
                                <!-- <span class="description">Shared publicly - 7:45 PM today</span> -->
                            </div>
                            {{-- <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore.
                            </p>
                            <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                            </p> --}}
                        </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{$avaliacao->titulo}}</h3>
                <p class="text-muted">{{$avaliacao->descricao}}</p>
                <br>
                <div class="text-muted">
                    <p class="text-sm">Cliente
                        <b class="d-block">{{$avaliacao->cliente}}</b>
                    </p>
                    <p class="text-sm">Criado por
                        <b class="d-block">{{$created_by_user}}</b>
                    </p>
                </div>
                {{-- <h5 class="mt-5 text-muted">Project files</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                    </li>
                </ul>
                <div class="text-center mt-5 mb-3">
                    <a href="#" class="btn btn-sm btn-primary">Add files</a>
                    <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                </div> --}}
            </div>
        </div>
    </div>

</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Estudantes que concluíram</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" title="Refresh" id="reload">
                <i class="fa fa-retweet" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    {{-- Setup data for datatables --}}
    @php
    $heads = [
    'ID',
    'Name',
    'Email',
    'Resultado',
    'Concluído em',
    ];

    $config = [
    "ajax"=>[
    'url'=>"/avaliacaoEstudante/$avaliacao->id",
    'dataSrc'=>"estudantes"
    ],
    'data'=>[
    ],
    'order' => [[4, 'desc']],
    'columns' => [
    ["data"=> "id"],
    ["data"=> "name"],
    ["data"=> "email"],
    ["data"=> "resultado"],
    ["data"=> "updated_at"],
    ],
    ];
    @endphp
    <div class="card-body">
        <div class="row">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed />
        </div>
    </div>

</div>

<x-footer />
@endsection

@push('js')
<script>
    const btnReload = document.getElementById('reload');
    btnReload.addEventListener('click', function() {
        $('#table2').DataTable().ajax.reload();
    })
</script>
@endpush
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)