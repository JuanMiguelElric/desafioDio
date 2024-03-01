<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "id",//id do colaborador auto incrementado no db Pessoa
        "nome_completo",//nome completo do colaborador
        "nome_social",//nome que o colaborador gostaria de ser chamado 
        "cpf",//cpf do colaborador 
        "telefone",//telefone do coloborador
        "whatsapp",//se o o colaborador tem ou não whatsapp
        "email",//email do colaborador para contato 
        "foto",
    ];

    public function empresa():BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
