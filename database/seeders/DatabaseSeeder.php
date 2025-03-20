<?php

namespace Database\Seeders;

use App\Models\Admin;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manufacturer;
use App\Models\Representative;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Representative::factory(2)->create();
        Manufacturer::factory(10)->create();


    }
}
