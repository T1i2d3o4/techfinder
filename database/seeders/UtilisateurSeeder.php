<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        // 1. On crée l'admin d'abord s'il n'existe pas déjà
        Utilisateur::updateOrCreate(
            ['login_user' => 'admin'], // Condition d'unicité
            [
                'code_user'     => 'ADMIN001',
                'nom_user'      => 'Admin',
                'prenom_user'   => 'Super',
                'password_user' => Hash::make('password123'),
                'tel_user'      => '699000000',
                'sex_user'      => 'M',
                'role_user'     => 'admin',
                'etat_user'     => 'actif',
            ]
        );

        // 2. On crée les 100 autres via la factory
        Utilisateur::factory(100)->create();
    }
}
