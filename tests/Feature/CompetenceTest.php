<?php

namespace Tests\Feature;

use App\Models\Competences;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testcompetencelist(): void
    {
        $response = $this->get('/api/competences');

        $response->assertStatus(200);
    }


    public function test_can_create_competence(): void
    {
        $payload = [
            'label_compo' => 'Expert Laravel',
            'description_comp' => 'Maîtrise des tests et des factories'
        ];

        // 2. On fait l'appel API (POST)
        $response = $this->postJson('/api/competences', $payload);

        // 3. On vérifie que l'API répond "201 Created"
        $response->assertStatus(201);

        // 4. TON DÉFI : Comment vérifier que la base de données
        // contient bien une ligne avec le label 'Expert Laravel' ?
        // (Indice : utilise $this->assertDatabaseHas('nom_table', [ ... ]))
        $this->assertDatabaseHas('competences',[
                'label_compo' =>'Expert Laravel',
                'description_comp' =>'Maîtrise des tests et des factories'
                ]);
    }

    public function test_can_destroy_competence(): void {
        $competence = Competences::factory()->create();

        $response = $this->delete('/api/competences/' . $competence->code_comp);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('competences', [
        'code_comp' => $competence->code_comp
         ]);

    }

}


