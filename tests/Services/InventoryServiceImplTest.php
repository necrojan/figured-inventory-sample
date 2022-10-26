<?php

namespace Tests\Services;

use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use App\Services\InventoryService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery\MockInterface;
use Tests\TestCase;

class InventoryServiceImplTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_valuation()
    {
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

        $totalInventoryCollection = Inventory::all();

        $arr = ['quantity' => 2];

        $this->mock(InventoryRepository::class, function (MockInterface $mock) use (
            $arr,
            $totalInventoryCollection) {
            $mock
                ->shouldReceive('inStock')
                ->once()
                ->andReturn(self::any());
            $mock
                ->shouldReceive('getTotal')
                ->once()
                ->andReturn($totalInventoryCollection->count());
            $mock
                ->shouldReceive('insert')
                ->once()
                ->with($arr)
                ->andReturn($totalInventoryCollection[0]);
            $mock
                ->shouldReceive('update')
                ->once()
                ->with($totalInventoryCollection[0]->id);
            $mock
                ->shouldReceive('getTotal')
                ->once()
                ->andReturn($totalInventoryCollection->count());
        });

        app(InventoryService::class)->process($arr);
    }
}
