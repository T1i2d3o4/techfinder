<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $order = 1;
    public function definition(): array
    {
        $numero = self::$order++;
        $codeGenere = 'USR-' . date('Y') . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);
        return [
            "code_user" => $codeGenere,
            "nom_user" => $this->faker->lastName(),
            "prenom_user"=> $this->faker->firstName(),
            "login_user" => $this->faker->unique()->userName(),
            "password_user" => bcrypt("password123"),
            "tel_user"=> $this->faker->phoneNumber(),
            "sex_user"=> $this->faker->randomElement(["M","F"]),
            "role_user" => $this->faker->randomElement(["technicien","client"]),
            "etat_user"=> $this->faker->randomElement(["actif","inatif","bloquer"])
        ];
    }
}
