<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pergunta extends Model
{
    use HasFactory;
    protected $table = "perguntas";
    protected $fillable = [
        "titulo"
    ];

    public function avaliacoes(): BelongsTo
    {
        return $this->belongsTo(Avaliacao::class);
    }
    public function respostas(): HasMany
    {
        return $this->hasMany(Respostas::class);
    }

    public function alternativas(): HasMany
    {
        return $this->hasMany(Alternativa::class);
    }
}
