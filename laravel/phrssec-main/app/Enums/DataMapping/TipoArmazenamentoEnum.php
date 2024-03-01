<?php
namespace App\Enums\DataMapping;


enum TipoArmazenamentoEnum:string implements EnumInterface
{

    case FISICO = "Físico";
    case DIGITAL = "Digital";
    case FISICO_DIGITAL = "Físico e Digital";

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