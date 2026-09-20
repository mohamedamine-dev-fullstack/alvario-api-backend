<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArticleCommande;

class ArticleCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCommande::firstOrCreate(
            [
                'commande_id' => 1,
                'produit_id' => 1,
                'variante_produit_id' => 1,
            ],
            [
                'quantite' => 1,
                'prix' => 49.90,
            ]
        );

        ArticleCommande::firstOrCreate(
            [
                'commande_id' => 1,
                'produit_id' => 2,
                'variante_produit_id' => 2,
            ],
            [
                'quantite' => 1,
                'prix' => 79.90,
            ]
        );

        ArticleCommande::firstOrCreate(
            [
                'commande_id' => 2,
                'produit_id' => 3,
                'variante_produit_id' => 4,
            ],
            [
                'quantite' => 2,
                'prix' => 39.90,
            ]
        );
    }
}
