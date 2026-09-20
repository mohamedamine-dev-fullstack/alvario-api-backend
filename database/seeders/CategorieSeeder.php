<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::updateOrCreate(
            ['slug' => 'soins-hygiene-homme'],
            [
                'nom' => 'Soins & Hygiène Homme',
                'image' => 'soins-hygiene-homme.jpg',
            ]
        );

        Categorie::updateOrCreate(
            ['slug' => 'casquettes-chapeaux'],
            [
                'nom' => 'Casquettes & Chapeaux',
                'image' => 'casquettes-chapeaux.jpg',
            ]
        );

        Categorie::updateOrCreate(
            ['slug' => 'sous-vetements-homme'],
            [
                'nom' => 'Sous-vêtements Homme',
                'image' => 'sous-vetements-homme.jpg',
            ]
        );
    }
}