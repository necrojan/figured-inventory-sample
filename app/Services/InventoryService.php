<?php

namespace App\Services;

interface InventoryService
{
    public function getAll();

    public function process(array $formData): array;
}
