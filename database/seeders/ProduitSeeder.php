<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produit::updateOrCreate(
            ['slug' => 'gel-douche-homme'],
            [
                'categorie_id' => 1,
                'nom' => 'Gel Douche Homme',
                'description' => 'Gel douche pour homme.',
                'prix' => 49.90,
                'ancien_prix' => 59.90,
                'stock' => 20,
                'statut' => 'actif',
            ]
        );

        Produit::updateOrCreate(
            ['slug' => 'casquette-classique'],
            [
                'categorie_id' => 2,
                'nom' => 'Casquette Classique',
                'description' => 'Casquette classique pour homme.',
                'prix' => 79.90,
                'ancien_prix' => null,
                'stock' => 15,
                'statut' => 'actif',
            ]
        );

        Produit::updateOrCreate(
            ['slug' => 'boxer-homme'],
            [
                'categorie_id' => 3,
                'nom' => 'Boxer Homme',
                'description' => 'Boxer confortable pour homme.',
                'prix' => 39.90,
                'ancien_prix' => 49.90,
                'stock' => 30,
                'statut' => 'actif',
            ]
        );
    }
}