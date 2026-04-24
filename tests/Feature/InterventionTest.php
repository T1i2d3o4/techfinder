<?php

namespace Tests\Feature;

use App\Models\Competences;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InterventionTest extends TestCase
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

    public function test_can_create_intervention():void
    {
        $client = Utilisateur::factory()->create(['role_user' => 'client']);
        $technicien = Utilisateur::factory()->create(['role_user' => 'technicien']);
        $comp = Competences::factory()->create();

       $payload = [
            'code_comp'        => $comp->code_comp,
            'code_user_client' => $client->code_user, // Correction ici
            'code_user_tech'   => $technicien->code_user, // Correction ici
            'note_int'         => 5 // Optionnel mais bien pour tester la validation
        ];

        $response = $this->postJson('/api/interventions', $payload);

        // 3. On vérifie que l'API répond "201 Created"
        $response->assertStatus(201);

        $this->assertDatabaseHas('intervation', [
            'code_comp'        => $comp->code_comp,
            'code_user_client' => $client->code_user,
            'code_user_tech'   => $technicien->code_user
        ]);

    }
}
