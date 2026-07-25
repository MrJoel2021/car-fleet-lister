<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class ItemSeederJSON extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Read the JSON file from database/data/cars.json
        $json = file_get_contents(database_path('data/cars.json'));

        // Convert JSON text into a PHP array
        $data = json_decode($json, true);

        // Loop through each vehicle in the JSON file
        foreach ($data as $item) {

            // Find the category if it already exists, or create it
            $category = Category::firstOrCreate([
                'name' => $item['category'],
            ]);

            // Save the vehicle and connect it to the category
            Item::create([
                'product' => $item['product'],

                // Keep the old category text column
                'category' => $item['category'],

                'quantity' => $item['quantity'],
                'price' => $item['price'],

                // New relationship column
                'category_id' => $category->id,
            ]);
        }
    }
}