<?php

namespace App\MovieDomain\User\Repository;

use App\Models\User as UserModel;
use App\MovieDomain\User\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): User;

    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function findByEmailAndPassword(string $email, string $password): User;

    /**
     * @param User $user
     * @return int
     */
    public function save(User $user): int;

    /**
     * @param int $id
     * @return UserModel
     */
    public function getUserModel(int $id): UserModel;
}
