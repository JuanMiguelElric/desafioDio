<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lias';

    protected $fillable = [
        'lia_descricao_finalidade',
        'lia_dados_pessoais_tratados',
        'lia_finalidade_letima',
        'lia_situacao_concreta',
        'lia_minimizacao',
        'lia_outras_bases_legais',
        'lia_legitima_expectativa',
        'lia_direitos_e_liberdades_fundamentais',
        'lia_transparencia',
        'lia_mecanismos_de_oposicao',
        'lia_mitigacao_de_riscos',
        'lia_aprovado',
        'lia_nome_do_dpo',
        'lia_data_da_avaliacao',
    ];
    
    protected $casts = [
        'lia_aprovado' => 'boolean',
    ];

    public function liaable(): MorphTo
    {
        return $this->morphTo();
    }
}
