<?php

namespace Database\Factories;

use App\Models\Competences;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervation>
 */
class IntervationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_comp' => fn () => Competences::inRandomOrder()->first()->code_comp,
            'code_user_client' => fn () => Utilisateur::where('role_user', 'client')->inRandomOrder()->first()->code_user,
            'code_user_tech' => fn () => Utilisateur::where('role_user', 'technicien')->inRandomOrder()->first()->code_user,
        ];
    }
}
