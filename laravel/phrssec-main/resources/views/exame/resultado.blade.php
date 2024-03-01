@extends('adminlte::page')
@section('title','Dashboard')
@section('content_header')
<!-- <h1></h1> -->
@endsection
@section('content')
<div class="container">
    <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-center text-muted border-bottom-0">
            <h2>{{$avaliacao->titulo}}</h2>
        </div>
        <div class="card-body pt-0">
            <div class="row d-flex justify-content-center">
                <div class="col-7">
                    <p>Você respondeu essa avaliação no dia {{$concluido[0]->updated_at->format('d/m/Y H:i:s')}}</p>
                    <p>O seu resultado foi</p>
                    <canvas id="myChart" class="chartjs-render-monitor"></canvas>
                    <p class="text-lg">{{$respostasStudent}} de {{$perguntasCount}}</p>
                    <p>Essa avaliação foi desenvolvida pela <strong><a href="{{route('index')}}" target="_blank">PHRSSEC - Segurança da informação</a></strong>.</p>
                    {{-- <p class="text-lg">Em caso de dúvida, <a href="#">consulte a central de ajuda.</a></p> --}} 
                    {{-- <p class="text-muted"><b>Perguntas: </b> {{$avaliacao->perguntas_count??""}} </p> --}} 
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <form action="{{route('estudante.index')}}" method="get">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Home
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    // Valor total e valor para "Acertos"
    var totalValue = parseInt("{{$perguntasCount}}");
    console.log(totalValue)
    var acertosValue = parseInt("{{$respostasStudent}}");
    // Calcula a porcentagem dos acertos em relação ao total
    // var acertosPercentage = (acertosValue / totalValue) * 100;
    // var totalPercentage = 100 - acertosPercentage;
    $(function() {


        // Obtenha o contexto do elemento canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Defina os dados do gráfico
        const data = {
            labels: [
                'Acertos',
                'Erros',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [acertosValue, totalValue - acertosValue],
                backgroundColor: [
                    'green',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 4
            }]
        };


        // Crie o gráfico
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
        });
        // myChart.data.datasets[0].data[0] = acertosValue + " / " + totalValue;
        // myChart.update();
    })
</script>
@endpush