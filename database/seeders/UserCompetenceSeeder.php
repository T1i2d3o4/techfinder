<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\Competences;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCompetenceSeeder extends Seeder
{
    public function run(): void
    {
        $users = Utilisateur::all();
        $competences = Competences::all();

        foreach ($users as $user) {
            // On prend entre 1 et 3 compétences au hasard pour chaque utilisateur
            $randomComps = $competences->random(rand(1, 3));

            foreach ($randomComps as $comp) {
                // updateOrInsert évite les doublons si le seeder tourne plusieurs fois
                DB::table('user_competence')->updateOrInsert([
                    'code_user' => $user->code_user,
                    'code_comp' => $user instanceof Competences ? $comp->id : $comp->code_comp,
                    // Note : utilise le nom de ta colonne clé primaire (id ou code_comp)
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
