<?php

namespace App\Services;

use App\Repositories\InventoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class InventoryServiceImpl implements InventoryService
{
    private InventoryRepository $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function getAll(): Collection
    {
        return $this->inventoryRepository->getAllByCreatedAtDesc();
    }

    public function getTotal()
    {
        return $this->inventoryRepository->getTotal();
    }

    /**
     * @param array $formData
     * @return array
     * @throws Exception
     */
    public function process(array $formData): array
    {
        $this->checkIfInStock();

        $this->checkIfMoreThanTheTotal($formData['quantity']);
        // update the inventory table by sto ring the application amount.
        $inventoryApplication = $this->inventoryRepository->insert($formData);
        // process the quantity and valuation of the items.
        $valuation = $this->inventoryRepository->update($inventoryApplication->id);

        return [
            'valuation' => $this->formatValuation($valuation),
            'total_units' => $this->getTotal()
        ];
    }

    protected function formatValuation($valuation): string
    {
        return number_format((float)$valuation, 2, '.', '');
    }

    protected function checkIfMoreThanTheTotal(int $quantity)
    {
        if ($quantity > $this->inventoryRepository->getTotal()) {
            abort(400, 'Requested quantity is more than the total');
        }
    }

    protected function checkIfInStock()
    {
        if (!$this->inventoryRepository->inStock()) {
            abort(400, 'No stock available');
        }
    }
}
