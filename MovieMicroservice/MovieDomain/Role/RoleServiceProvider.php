<?php

namespace App\MovieDomain\Role;

use App\MovieDomain\Role\Repository\RoleRepository;
use App\MovieDomain\Role\Repository\RoleRepositoryInterface;
use App\MovieDomain\Role\Service\RoleService;
use App\MovieDomain\Role\Service\RoleServiceInterface;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(RoleServiceInterface::class, RoleService::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
    }
}
