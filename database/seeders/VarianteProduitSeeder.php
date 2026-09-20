<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VarianteProduit;

class VarianteProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         VarianteProduit::firstOrCreate([
            'produit_id' => 1,
            'taille' => '500ml',
            'couleur' => null,
            'stock' => 20,
        ]);

        VarianteProduit::firstOrCreate([
            'produit_id' => 2,
            'taille' => 'Unique',
            'couleur' => 'Noir',
            'stock' => 8,
        ]);

        VarianteProduit::firstOrCreate([
            'produit_id' => 2,
            'taille' => 'Unique',
            'couleur' => 'Bleu',
            'stock' => 7,
        ]);

        VarianteProduit::firstOrCreate([
            'produit_id' => 3,
            'taille' => 'M',
            'couleur' => 'Noir',
            'stock' => 10,
        ]);

        VarianteProduit::firstOrCreate([
            'produit_id' => 3,
            'taille' => 'L',
            'couleur' => 'Noir',
            'stock' => 10,
        ]);

        VarianteProduit::firstOrCreate([
            'produit_id' => 3,
            'taille' => 'XL',
            'couleur' => 'Noir',
            'stock' => 10,
        ]);
    }
}
