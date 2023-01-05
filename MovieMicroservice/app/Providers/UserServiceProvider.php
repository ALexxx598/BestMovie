<?php

namespace App\Providers;

use App\MovieDomain\Role\Repository\RoleRepositoryInterface;
use App\MovieDomain\User\Hash\HashService;
use App\MovieDomain\User\Hash\HashServiceInterface;
use App\MovieDomain\User\Repository\UserRepository;
use App\MovieDomain\User\Repository\UserRepositoryInterface;
use App\MovieDomain\User\Service\UserService;
use App\MovieDomain\User\Service\UserServiceInterface;
use App\MovieDomain\User\Token\UserTokenRepository;
use App\MovieDomain\User\Token\UserTokenRepositoryInterface;
use App\MovieDomain\User\Token\UserTokenService;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use App\MovieDomain\User\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        // TODO parse on methods
        $this->app->singleton(UserServiceInterface::class, UserService::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(HashServiceInterface::class, HashService::class);
        $this->app->singleton(UserTokenServiceInterface::class, UserTokenService::class);
        $this->app->singleton(UserTokenRepositoryInterface::class, UserTokenRepository::class);
    }

    public function boot()
    {
        User::setRoleRepositoryResolver(function () {
            return $this->app[RoleRepositoryInterface::class];
        });
        User::setUserRepositoryResolver(function () {
            return $this->app[UserRepositoryInterface::class];
        });
    }
}
