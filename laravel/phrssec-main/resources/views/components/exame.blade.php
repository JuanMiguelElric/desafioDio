@extends('adminlte::page')
@section('title', $avaliacao->titulo)
@section('content')
<div class="container py-4">
    <x-error />
    <h2>{{$avaliacao->titulo}}</h2>
    {{$perguntas->links()}}
    <div class="card">
        <div class="card-header">
            {{$perguntas[0]->titulo}}
        </div>
        <div class="card-body">
            <form id="form" method="POST" action="/estudante/avaliacao/{{$avaliacao->id}}">
                @csrf
                <input type="hidden" name="nextPage" value="@if($perguntas->hasMorePages()) {{$perguntas->currentPage()+1}} @else {{$perguntas->lastPage()}} @endif">
                <input type="hidden" name="pergunta_id" value="{{$perguntas[0]->id}}">
                @foreach ($perguntas as $pergunta)
                @foreach ($pergunta->alternativas as $key => $alternativa)
                <div class="form-check mb-4 py-2">
                    <input type="radio" name="alternativa_id" id="alternativa{{$alternativa->id}}" class="form-check-input" value="{{$alternativa->id}}" @if($alternativa->respondido)
                    checked
                    @endif
                    >
                    <label for="alternativa{{$alternativa->id}}" value="{{$alternativa->id}}" class="form-check-label">{{ chr(65 + $key) }}) {{$alternativa->opcao}}</label>
                </div>
                @endforeach
                @endforeach
                <div class="d-flex ">
                    <button type="submit" class="btn btn-primary mt-3 mr-3">Enviar</button>
                    @if(!$perguntas->hasMorePages())
                    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#staticBackdrop">
                        Finalizar
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    @if(!$perguntas->hasMorePages())
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Finalizar avaliação?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    <form action="/estudante/avaliacao/{{$avaliacao->id}}/finalizar" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
@endsection