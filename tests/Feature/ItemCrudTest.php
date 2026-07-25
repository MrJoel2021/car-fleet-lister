<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemCrudTest extends TestCase
{
    // This refreshes the test database before each test
    use RefreshDatabase;

    /**
     * Test that the items index page loads.
     */
    public function test_items_index_page_loads(): void
    {
        // Visit the items page
        $response = $this->get('/items');

        // Check the page loads successfully
        $response->assertStatus(200);

        // Check the page contains this text
        $response->assertSee('Car Fleet Listing');
    }

    /**
     * Test that a vehicle can be created.
     */
    public function test_vehicle_can_be_created(): void
    {
        // Send form data to the store route
        $response = $this->post(route('items.store'), [
            'product' => 'Skoda Octavia',
            'category' => 'Compact',
            'quantity' => 7,
            'price' => 75,
        ]);

        // Check it redirects back to the items list
        $response->assertRedirect(route('items.index'));

        // Check the vehicle was saved in the database
        $this->assertDatabaseHas('items', [
            'product' => 'Skoda Octavia',
            'category' => 'Compact',
            'quantity' => 7,
            'price' => 75,
        ]);
    }

    /**
     * Test that a vehicle can be updated.
     */
    public function test_vehicle_can_be_updated(): void
    {
        // Create a fake vehicle first
        $item = Item::factory()->create([
            'product' => 'Toyota Corolla',
            'category' => 'Economy',
            'quantity' => 5,
            'price' => 60,
        ]);

        // Send updated form data
        $response = $this->put(route('items.update', $item), [
            'product' => 'Toyota Corolla',
            'category' => 'Economy',
            'quantity' => 10,
            'price' => 65,
        ]);

        // Check it redirects back to the items list
        $response->assertRedirect(route('items.index'));

        // Check the database has the updated values
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'quantity' => 10,
            'price' => 65,
        ]);
    }

    /**
     * Test that a vehicle can be deleted.
     */
    public function test_vehicle_can_be_deleted(): void
    {
        // Create a fake vehicle
        $item = Item::factory()->create();

        // Send delete request
        $response = $this->delete(route('items.destroy', $item));

        // Check it redirects back to the items list
        $response->assertRedirect(route('items.index'));

        // Check the vehicle is no longer in the database
        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }

    /**
     * Test validation when the form is empty.
     */
    public function test_create_vehicle_requires_validation(): void
    {
        // Send empty form data
        $response = $this->post(route('items.store'), []);

        // Check validation errors happen
        $response->assertSessionHasErrors([
            'product',
            'category',
            'quantity',
            'price',
        ]);
    }

    /**
     * Test that the low stock page only shows vehicles below the threshold.
     */
    public function test_low_stock_page_shows_low_quantity_items(): void
    {
        // Create a low stock vehicle
        Item::factory()->create([
            'product' => 'BMW 3 Series',
            'category' => 'Luxury',
            'quantity' => 3,
            'price' => 120,
        ]);

        // Create a normal stock vehicle
        Item::factory()->create([
            'product' => 'Toyota Corolla',
            'category' => 'Economy',
            'quantity' => 10,
            'price' => 60,
        ]);

        // Visit the low stock page
        $response = $this->get('/items/lowstock/5');

        // Check the page loads successfully
        $response->assertStatus(200);

        // Check low stock vehicle appears
        $response->assertSee('BMW 3 Series');

        // Check normal stock vehicle does not appear
        $response->assertDontSee('Toyota Corolla');
    }
}