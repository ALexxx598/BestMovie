<?php

namespace App\MovieDomain\User\Repository;

use Closure;

trait UserRepositoryFinderTrait
{
    private static ?Closure $userRepositoryResolver;

    private static ?UserRepositoryInterface $userRepository;

    /**
     * @param Closure|null $resolver
     */
    public static function setUserRepositoryResolver(?Closure $resolver = null)
    {
        static::$userRepository = null;

        static::$userRepositoryResolver = $resolver;
    }

    /**
     * @return UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface
    {
        return static::$userRepository ?? static::$userRepository = call_user_func(static::$userRepositoryResolver);
    }

    /***
     * @param UserRepositoryInterface $repository
     */
    public static function setUserRepository(UserRepositoryInterface $repository)
    {
        static::$userRepository = $repository;
    }
}
