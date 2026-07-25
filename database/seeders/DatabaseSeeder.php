<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the JSON seeder
        $this->call([
            ItemSeederJSON::class,
        ]);
    }
}