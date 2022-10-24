<?php

namespace Tests\Feature;

use App\Models\Inventory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InventoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_store_the_quantity_request_value()
    {
        $this->withoutExceptionHandling();
        Inventory::factory()->create([
            'type' => 'Purchase',
            'quantity' => 1,
            'unit_price' => 10.00
        ]);

        Inventory::factory()->create([
            'type' => 'Purchase',
            'quantity' => 2,
            'unit_price' => 20.00
        ]);

        Inventory::factory()->create([
            'type' => 'Purchase',
            'quantity' => 2,
            'unit_price' => 15.00
        ]);
        $response = $this->post('/inventories', [
            'quantity' => 2
        ]);

        $data = json_decode($response->getContent(), true);
        // dd($data);
        $response->assertStatus(200);

        tap(Inventory::latest('id')->first(), function ($inventory) {
            $this->assertEquals(-2, $inventory->quantity);
            $this->assertEquals('Application', $inventory->type);
        });
        $this->assertEquals(30., $data['valuation']);
    }
}
