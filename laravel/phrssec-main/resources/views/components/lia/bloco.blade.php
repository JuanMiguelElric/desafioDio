<div class="row  mt-3 border rounded py-3 align-items-center">
    <div class="col-md-4 text-center">
        <h4>{{ $baseLegal }}</h4>
        <h5>{{ $baseLegalLei }}</h5>
        @if (isset($baseLegalObs))
            <p>{{ $baseLegalObs }}</p>
        @endif
    </div>
    <div class="col-md-8 text-center align-items-center">
        @if ($blocoInfo)
            @foreach ($blocoInfo as $bloco)
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4>{{ $bloco['detalhes'] }}</h4>
                        <p class="text-justify">{{ $bloco['detalhesObs'] }}
                        </p>
                    </div>
                    <div class="col-md-6 ">
                        <x-adminlte-textarea name="{{ $bloco['name'] }}" label="" placeholder="">
                            @if(old($bloco['name']))
                            {{ old($bloco['name']) }}
                            @endif
                        </x-adminlte-textarea>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
