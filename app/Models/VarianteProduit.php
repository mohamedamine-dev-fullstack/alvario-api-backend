<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianteProduit extends Model
{
    protected $table = 'variantes_produit';

    protected $fillable = [
        'produit_id',
        'taille',
        'couleur',
        'stock',
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
