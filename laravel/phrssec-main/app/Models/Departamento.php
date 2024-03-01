<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'responsavel',
        'telefone',
        'email',
        'status',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
