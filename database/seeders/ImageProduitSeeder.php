<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImageProduit;


class ImageProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageProduit::updateOrCreate(
            [
                'produit_id' => 1,
                'image' => 'gel-douche-homme.jpg',
            ]
        );

        ImageProduit::updateOrCreate(
            [
                'produit_id' => 2,
                'image' => 'casquette-classique.jpg',
            ]
        );

        ImageProduit::updateOrCreate(
            [
                'produit_id' => 3,
                'image' => 'boxer-homme.jpg',
            ]
        );
    }
}
