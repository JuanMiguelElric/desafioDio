<?php

namespace App\Models;

use App\Http\Controllers\DataMapping\pessoa\PessoaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
        'status',
        'observacao',
        'created_by'
    ];

    protected $casts = [
    ];


    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
    public function cargos():HasMany
    {
        return $this->hasMany(Cargo::class);
    }
    
    public function processos(): HasMany
    {
        return $this->hasMany(Processo::class);
    }

    public function terceiros(): HasMany
    {
        return $this->hasMany(Terceiro::class);
    }
    //adicionando método para pessoas
    public function pessoas(): HasMany
    {
        return $this->hasMany(Pessoa::class);
    }



    public function filiais(): HasMany
    {
        return $this->hasMany(Filial::class);
    }

}
