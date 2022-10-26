<?php

namespace App\Repositories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Collection;

class InventoryRepositoryImpl implements InventoryRepository
{
    /**
     * @var Inventory
     */
    private Inventory $inventory;

    /**
     * @param Inventory $inventory
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * @return Collection
     */
    public function getAllByCreatedAtDesc(): Collection
    {
        return $this->inventory->get();
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->inventory->sum('quantity');
    }

    /**
     * @return bool
     */
    public function inStock(): bool
    {
        $total = $this->getTotal();

        return $total > 0;
    }


    /**
     * @param $id
     * @return false|mixed
     */
    public function update($id)
    {
        $currentStocks = [];
        $processedStocks = [];

        $this->getAllByCreatedAtDesc()
            ->each(function ($item, $key) use (&$currentStocks, &$processedStocks) {
            if ($item->type == Inventory::TYPE_PURCHASE) {
                $currentStocks[$item->id] = $item;
            } else {
                // this is the item instance with type of application
                // make the negative value of quantity positive.
                $applicationTypeItem = abs($item->quantity);
                $valuation = 0;

                while ($applicationTypeItem > 0) {
                    // reset the array pointer and always get the first purchased item.
                    $firstItem = reset($currentStocks);
                    // if the requested quantity is more than the current
                    // quantity of the item.
                    if ($applicationTypeItem > $firstItem->quantity) {
                        // subtract the application quantity to the item quantity
                        $applicationTypeItem -= $firstItem->quantity;
                        // get the value of the item
                        $valuation = $this->calculatePrice($valuation, $firstItem->quantity, $firstItem->unit_price);

                        unset($currentStocks[$firstItem->id]);
                    } else {
                        // subtract the application value to the item quantity.
                        $currentStocks[$firstItem->id]['quantity'] -= $applicationTypeItem;

                        $valuation = $this->calculatePrice($valuation, $applicationTypeItem, $firstItem->unit_price);

                        $applicationTypeItem = 0;
                    }
                }
                $processedStocks[$item->id] = $valuation;
            }
        });

        return $processedStocks[$id] ?? end($processedStocks);
    }

    /**
     * @param array $formData
     * @return mixed
     */
    public function insert(array $formData)
    {
        return $this->inventory->create([
            'type' => Inventory::TYPE_APPLICATION,
            'quantity' => abs($formData['quantity']) * -1
        ]);
    }

    /**
     * @param string $valuation
     * @param string $quantity
     * @param string $unitPrice
     * @return string
     */
    protected function calculatePrice(string $valuation, string $quantity,  string $unitPrice): string
    {
        return bcadd($valuation, bcmul($quantity, $unitPrice, 2), 2);
    }
}
