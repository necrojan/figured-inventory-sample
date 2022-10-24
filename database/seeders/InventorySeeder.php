<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->processData() as $data) {
            Inventory::insert($data);
        }
    }

    /**
     * The given data.
     *
     * @return string[][]
     */
    private function processData(): array
    {
        return [
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 10,
                'unit_price' => 5,
                'created_at' => '2020-06-05',
                'updated_at' => '2020-06-05',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 30,
                'unit_price' => 4.5,
                'created_at' => '2020-06-07',
                'updated_at' => '2020-06-07',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -20,
                'created_at' => '2020-06-08',
                'updated_at' => '2020-06-08',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 10,
                'unit_price' => 5,
                'created_at' => '2020-06-09',
                'updated_at' => '2020-06-09',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 34,
                'unit_price' => 4.5,
                'created_at' => '2020-06-10',
                'updated_at' => '2020-06-10',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -25,
                'created_at' => '2020-06-15',
                'updated_at' => '2020-06-15',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -37,
                'created_at' => '2020-06-23',
                'updated_at' => '2020-06-23',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 47,
                'unit_price' => 4.3,
                'created_at' => '2020-07-10',
                'updated_at' => '2020-07-10',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -38,
                'created_at' => '2020-07-12',
                'updated_at' => '2020-07-12',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 10,
                'unit_price' => 5,
                'created_at' => '2020-07-13',
                'updated_at' => '2020-07-13',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 50,
                'unit_price' => 4.2,
                'created_at' => '2020-07-25',
                'updated_at' => '2020-07-25',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -28,
                'created_at' => '2020-07-26',
                'updated_at' => '2020-07-26',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 10,
                'unit_price' => 5,
                'created_at' => '2020-07-31',
                'updated_at' => '2020-07-31',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 15,
                'unit_price' => 5,
                'created_at' => '2020-08-14',
                'updated_at' => '2020-08-14',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 3,
                'unit_price' => 6,
                'created_at' => '2020-08-17',
                'updated_at' => '2020-08-17',
            ],
            [
                'type' => Inventory::TYPE_PURCHASE,
                'quantity' => 2,
                'unit_price' => 7,
                'created_at' => '2020-08-29',
                'updated_at' => '2020-08-29',
            ],
            [
                'type' => Inventory::TYPE_APPLICATION,
                'quantity' => -30,
                'created_at' => '2020-08-31',
                'updated_at' => '2020-08-31',
            ],
        ];
    }
}
