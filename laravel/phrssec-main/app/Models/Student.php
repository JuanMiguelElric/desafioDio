<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'terms',
        'email_verified_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed'
    ];
    public function adminlte_image()
    {
        if($this->photo){
            return asset(Storage::url($this->photo));
        }
        return asset(Storage::url('avatar.png'));
    }

    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'estudante/profile';
    }

    public function avaliacoes(): BelongsToMany
    {
        return $this->belongsToMany(Avaliacao::class, 'avaliacoes_estudantes')->withPivot('concluido')->withTimestamps();
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
