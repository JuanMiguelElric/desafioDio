<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "id",
        "nome_do_cargo"
    ];
    public function empresa():BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    public function pessoas():HasMany
    {
        return $this->hasMany(Pessoa::class);
    }
}
