<?php

namespace Database\Seeders;

use App\Models\Paiement;
use App\Models\User;
use App\Models\Utilisateur;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Paiement::factory()->count(250)->create();
    }
}
