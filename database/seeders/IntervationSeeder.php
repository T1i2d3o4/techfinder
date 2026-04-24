<?php

namespace Database\Seeders;

use App\Models\Intervation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntervationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use RefreshDatabase;
    public function run(): void
    {
        //
        Intervation::factory(100)->create();
    }
}
