<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageProduit extends Model
{
    protected $table = 'image_produit';

    protected $fillable = [
        'produit_id',
        'image',
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
