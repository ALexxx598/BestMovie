<?php

namespace App\MovieDomain\Role\Repository;

use Closure;

trait RoleRepositoryFinderTrait
{
    private static ?Closure $roleRepositoryResolver;

    private static RoleRepositoryInterface $roleRepository;

    /**
     * @param Closure|null $resolver
     */
    public static function setRoleRepositoryResolver(?Closure $resolver = null)
    {
        static::$roleRepository = null;

        static::$roleRepositoryResolver = $resolver;
    }

    /**
     * @return RoleRepositoryInterface
     */
    public function getRoleRepository(): RoleRepositoryInterface
    {
        return static::$roleRepository ?? static::$roleRepository = call_user_func(static::$roleRepositoryResolver);
    }

    /***
     * @param RoleRepositoryInterface $repository
     */
    public static function setRoleRepository(RoleRepositoryInterface $repository)
    {
        static::$roleRepository = $repository;
    }
}
