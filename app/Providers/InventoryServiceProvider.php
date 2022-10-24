<?php

namespace App\Providers;

use App\Repositories\InventoryRepository;
use App\Repositories\InventoryRepositoryImpl;
use App\Services\InventoryService;
use App\Services\InventoryServiceImpl;
use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InventoryService::class, InventoryServiceImpl::class);
        $this->app->bind(InventoryRepository::class, InventoryRepositoryImpl::class);
    }
}
