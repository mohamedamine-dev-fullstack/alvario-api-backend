<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utilisateur::updateOrCreate(
            ['email' => 'admin@alvario.ma'],
            [
                'nom' => 'Admin Alvario',
                'mot_de_passe' => Hash::make('password123'),
                'telephone' => '0600000000',
                'role' => 'admin',
            ]
        );

        Utilisateur::updateOrCreate(
            ['email' => 'client@alvario.ma'],
            [
                'nom' => 'Client Alvario',
                'mot_de_passe' => Hash::make('password123'),
                'telephone' => '0611111111',
                'role' => 'client',
            ]
        );
    }
}
