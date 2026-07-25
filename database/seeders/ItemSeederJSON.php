<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeederJSON extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the JSON file from database/data/cars.json
        $json = file_get_contents(database_path('data/cars.json'));

        // Convert JSON into a PHP array
        $data = json_decode($json, true);

        // Loop through each vehicle and save it to the database
        foreach ($data as $item) {
            Item::create([
                'product' => $item['product'],
                'category' => $item['category'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    }
}