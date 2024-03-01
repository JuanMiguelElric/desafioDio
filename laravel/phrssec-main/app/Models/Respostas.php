<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Respostas extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'avaliacao_id',
        'pergunta_id',
        'alternativa_id',
    ];

    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function avaliacoes(): BelongsTo
    {
        return $this->belongsTo(Avaliacao::class, 'avaliacao_id', 'id');
    }
    public function perguntas(): BelongsTo
    {
        return $this->belongsTo(Pergunta::class, 'pergunta_id', 'id');
    }
    public function alternativas(): BelongsTo
    {
        return $this->belongsTo(Alternativa::class, 'alternativa_id', 'id');
    }
}
