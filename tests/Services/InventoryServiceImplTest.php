<?php

namespace Tests\Services;

use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use App\Repositories\InventoryRepositoryImpl;
use App\Services\InventoryService;
use App\Services\InventoryServiceImpl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class InventoryServiceImplTest extends TestCase
{
    use DatabaseMigrations;

    protected InventoryService $inventoryService;

    /** @test */
    public function it_returns_the_valuation()
    {
        $this->markTestIncomplete();
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

        $totalInventory = Inventory::all();
        $totalInventory->first()->id = 1;

        $arr = ['quantity' => 2];

        $this->mock(InventoryRepository::class, function (MockInterface $mock) use ($arr, $totalInventory) {
            $mock
                ->shouldReceive('inStock')
                ->once()
                ->andReturn(self::any());
            $mock
                ->shouldReceive('getTotal')
                ->once()
                ->andReturn($totalInventory->count());
            $mockedInsert = $mock
                ->shouldReceive('insert')
                ->once()
                ->with($arr)
                ->andReturn($totalInventory);
        });

        app(InventoryService::class)->process($arr);
    }
}
