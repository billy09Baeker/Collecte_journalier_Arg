<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Collecteur;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Collecteur::factory(10)->create()->each(function($collecteur){
            $numClients = random_int(1,10);
            Client::factory()->count($numClients)
                ->for($collecteur)
                ->create();
    
        });
    }    
}
