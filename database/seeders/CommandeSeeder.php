<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commande;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commande::firstOrCreate(
            [
                'utilisateur_id' => 2,
                'adresse' => '123 Boulevard Mohammed V',
            ],
            [
                'nom_complet' => 'Client Alvario',
                'telephone' => '0611111111',
                'ville' => 'Casablanca',
                'prix_total' => 129.80,
                'statut' => 'en attente',
                'methode_paiement' => 'paiement à la livraison',
            ]
        );

        Commande::firstOrCreate(
            [
                'utilisateur_id' => 2,
                'adresse' => '45 Avenue Hassan II',
            ],
            [
                'nom_complet' => 'Client Alvario',
                'telephone' => '0611111111',
                'ville' => 'Rabat',
                'prix_total' => 79.90,
                'statut' => 'confirmée',
                'methode_paiement' => 'paiement à la livraison',
            ]
        );
    }
}
