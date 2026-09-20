<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleCommande extends Model
{
    protected $table = 'articles_commande';

    protected $fillable = [
        'commande_id',
        'produit_id',
        'variante_produit_id',
        'quantite',
        'prix',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function variante(): BelongsTo
    {
        return $this->belongsTo(VarianteProduit::class, 'variante_produit_id');
    }
}
