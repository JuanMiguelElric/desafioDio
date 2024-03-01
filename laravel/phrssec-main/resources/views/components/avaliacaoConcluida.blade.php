<div class="card bg-light d-flex flex-fill">
    <div class="card-header text-muted border-bottom-0">
        {{$avaliacao->titulo}}
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-7">
                <!-- <h2 class="lead"><b>Nicole Pearson</b></h2> -->
                <p class="text-muted text-sm"><b>Perguntas: </b> {{$avaliacao->perguntas_count}}  </p>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <!-- <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li> -->
                </ul>
            </div>
            <!-- <div class="col-5 text-center">
                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
            </div> -->
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right">
            <form action="{{route('estudante.resultado', $avaliacao->id)}}" method="get">
                <button type="submit" class="btn btn-sm btn-success">
                    Resultado
                </button>
            </form>
        </div>
    </div>
</div>