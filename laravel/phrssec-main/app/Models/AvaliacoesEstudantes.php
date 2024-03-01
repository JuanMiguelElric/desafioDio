<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AvaliacoesEstudantes extends Model
{
    use HasFactory;
    
    protected $table = 'avaliacoes_estudantes';

    protected $fillable = [
        'student_id',
        'avaliacao_id',
        'concluido'
    ];

    protected $casts = [
        'concluido' => 'boolean'
    ];

    public function students():BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
    
    public function avaliacoes():BelongsToMany
    {
        return $this->belongsToMany(Avaliacao::class);
    }

}
