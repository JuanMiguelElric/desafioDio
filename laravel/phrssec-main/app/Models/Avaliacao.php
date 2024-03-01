<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = [
        "titulo",
        "cliente",
        'descricao',
        "created_by_user_id"
    ];


    public function perguntas(): HasMany
    {
        return $this->hasMany(Pergunta::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,'avaliacoes_estudantes')->withPivot('concluido')->withTimestamps();
    }
    public function avaliacoes_estudantes():HasMany
    {
        return $this->hasMany(AvaliacoesEstudantes::class);
    }
    public function respostas(): HasMany
    {
        return $this->hasMany(Respostas::class);
    }
}
