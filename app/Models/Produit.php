<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'categorie_id',
        'nom',
        'slug',
        'description',
        'prix',
        'ancien_prix',
        'stock',
        'statut',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageProduit::class, 'produit_id');
    }

    public function variantes(): HasMany
    {
        return $this->hasMany(VarianteProduit::class, 'produit_id');
    }
}
