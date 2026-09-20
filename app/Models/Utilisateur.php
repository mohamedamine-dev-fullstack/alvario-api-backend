<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Model
{
    use HasApiTokens;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'telephone',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'utilisateur_id');
    }
}
