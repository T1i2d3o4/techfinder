<?php

namespace Database\Factories;

use App\Models\Competences;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCompetence>
 */
class UserCompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'code_user' => fn () => Utilisateur::inRandomOrder()->first()->code_user,
        'code_comp' => fn () => Competences::inRandomOrder()->first()->code_comp,
    ];
}
}
