<?php

namespace App\MovieDomain\User\Service;

use App\MovieDomain\Role\RoleType;
use App\MovieDomain\User\Payload\UserCreatePayload;
use App\MovieDomain\User\Payload\UserUpdatePayload;
use App\MovieDomain\User\User;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User;

    /**
     * @param UserCreatePayload $userPayload
     * @return User
     */
    public function create(UserCreatePayload $userPayload): User;

    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function getUserByEmailAndPassword(string $email, string $password): User;

    /**
     * @param int $id
     * @param RoleType $roleType
     * @return bool
     */
    public function hasRole(int $id, RoleType $roleType): bool;

    /**
     * @param UserUpdatePayload $updatePayload
     * @return User
     */
    public function update(UserUpdatePayload $updatePayload): User;
}
