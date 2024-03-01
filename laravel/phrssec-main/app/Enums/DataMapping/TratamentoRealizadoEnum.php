<?php

namespace App\Enums\DataMapping;

enum TratamentoRealizadoEnum: string implements EnumInterface
{

    case COLETA           = 'Coleta: Obtenção, recepção ou produção';
    case RETENCAO         = 'Retenção: Arquivamento ou armazenamento';
    case PROCESSAMENTO    = 'Processamento: Classificação, utilização, reprodução, avaliação ou controle da informação, extração e modificação';
    case COMPARTILHAMENTO = 'Compartilhamento: reprodução, transmissão, distribuição, comunicação, transferência, difusão e compartilhamento';
    case ELIMINACAO       = 'Eliminação: Apagar, descartar, eliminar';

    public static function iterarEnum(): array
    {
        $baseLegalOptions = [];
        $className = get_called_class();
        foreach ($className::cases() as $case) {
            $baseLegalOptions[$case->value] = $case->value;
        }
        return $baseLegalOptions;
    }
}
