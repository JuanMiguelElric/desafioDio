<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternativa extends Model
{
    use HasFactory;
    protected $table = "alternativas";

    protected $fillable=[
        "opcao",
        "verdadeiro"
    ];

    protected $casts = [
        'verdadeiro' => 'boolean'
    ];

    public function perguntas(): BelongsTo
    {
        return $this->belongsTo(Pergunta::class);
    }
    
    public function respostas(): HasMany
    {
        return $this->hasMany(Respostas::class);
    }
}
