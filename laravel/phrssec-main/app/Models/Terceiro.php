<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terceiro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "cod",  //dmt- Número de identificação do terceiro analisado			
        "nome_terceiro",  // Nome do terceiro analisado			
        //removido"descricao"                     ,  //Descrição do terceiro analisado para auxiliar a sua identificação			
        //removido"localizacao_fisica_pais_estado",  //Indicação da localização física do armazenamento
        //removido"responsavel_interno_ativo"     ,  //Responsável pelo terceiro dentro da empresa			
        //removido"tipo_servico_prestado"         ,  //Indicação de qual serviços é prestado pelo terceiro	 Pode ser: a) Consultoria, b) Operação, c) Regulatório, d) Estratégico, e) Tecnológico.											
        //removido "status"                        ,  //Status se a relação com o terceiro está ativa ou inativa			 Poder ser: a) Ativo, b) Inativo.									
        //removido "importancia"                   ,  //Grau de relevância da terceiro com o terceiro para a empresa	Pode ser: a) Crítica, b) Alta, c) Moderada, d) Baixa.											
        "site_terceiro",  //Link do website do terceiro			
        "cnpj_terceiro",  //Nº do CNPJ do terceiro			
        "nome_do_representante",  //Nome completo do representante ou ponto focal do terceiro			
        "email_do_representante",  //E-mail do representante ou ponto focal do terceiro			
        "telefone_do_representante",  //Número de telefone do representante ou ponto focal do terceiro			
        //removido"responsavel_interno_terceiro"  ,  //Responsável pelo terceiro dentro da empresa			
    ];

    // protected $casts = [
    //     'status' => 'boolean'
    // ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    protected static function booted(): void
    {
        static::created(function (Terceiro $terceiro) {
            $terceiro->fill(['cod' => "dmt-" . $terceiro->id]);
            $terceiro->save();
        });
    }
}
