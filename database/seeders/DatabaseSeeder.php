<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        //  run seeded master tables
        $this->call(MasterTablesSeeder::class);


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+15550001234',
        ]);

    
    }
}
