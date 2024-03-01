<?php

namespace App\Enums\DataMapping;

enum VolumeDeDadosPessoaisEnum: string implements EnumInterface
{
    case NAO_APLICAVEL         = "Não Aplicável";
    case ZERO_MIL              = "0 - 1.000";
    case MIL_DEZ_MIL           = "1.000 - 10.000";
    case DEZ_MIL_CEM_MIL       = "10.000 - 100.000";
    case CEM_MIL_UM_MILHAO     = "100.000 - 1M";
    case UM_MILHAO_DEZ_MILHOES = "1M - 10M";
    case MAI_DEZ_MILHOES       = "> 10M";

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
