<?php

namespace App\Repositories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Collection;

interface InventoryRepository
{
    public function getAllByCreatedAtDesc(): Collection;

    public function update(int $id);

    public function insert(array $formData);
}
