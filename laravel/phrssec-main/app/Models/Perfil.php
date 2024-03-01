<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'endereco',
        'telefone',
        'cpf_cnpj',
        'rg',
        'genero',
        'data_nascimento'
    ];
}
