<?php

namespace Database\Seeders;

use App\Models\Admin;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Representative;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Admin::factory(20)->create();
        Manufacturer::factory(20)->create();
        Representative::factory(10)->create();
        Product::factory(20)->create();
        Item::factory(20)->create();


    }
}
