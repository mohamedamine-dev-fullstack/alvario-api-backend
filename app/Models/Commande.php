<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'utilisateur_id',
        'nom_complet',
        'telephone',
        'ville',
        'adresse',
        'prix_total',
        'statut',
        'methode_paiement',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(ArticleCommande::class, 'commande_id');
    }
}
