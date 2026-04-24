<?php

namespace Tests\Feature;

use App\Models\Competences;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCompetenceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_attach_competence_to_user(): void
    {
        // 1. Préparer les données
        $user = Utilisateur::factory()->create();
        $comp = Competences::factory()->create();

        $payload = [
            'code_user' => $user->code_user,
            'code_comp' => $comp->code_comp
        ];

        // 2. Action
        $response = $this->postJson('/api/user-competences', $payload);

        // 3. Assertions
        $response->assertStatus(201);

        $this->assertDatabaseHas('user_competence', [
            'code_user' => $user->code_user,
            'code_comp' => $comp->code_comp
        ]);
    }



}
