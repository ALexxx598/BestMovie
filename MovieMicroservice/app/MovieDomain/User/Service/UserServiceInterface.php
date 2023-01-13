<?php

namespace App\MovieDomain\User\Service;

use App\MovieDomain\Role\RoleType;
use App\MovieDomain\User\Exception\NonValidPasswordException;
use App\MovieDomain\User\Exception\UserNotFoundException;
use App\MovieDomain\User\Payload\UserCreatePayload;
use App\MovieDomain\User\Payload\UserUpdatePayload;
use App\MovieDomain\User\User;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUser(int $id): User;

    /**
     * @param UserCreatePayload $userPayload
     * @return User
     */
    public function create(UserCreatePayload $userPayload): User;

    /**
     * @param string $email
     * @param string $password
     * @return User
     * @throws NonValidPasswordException
     * @throws UserNotFoundException
     */
    public function getUserByEmailAndPassword(string $email, string $password): User;

    /**
     * @param int $id
     * @param RoleType $roleType
     * @return bool
     * @throws UserNotFoundException
     */
    public function hasRole(int $id, RoleType $roleType): bool;

    /**
     * @param UserUpdatePayload $updatePayload
     * @return User
     * @throws UserNotFoundException
     */
    public function update(UserUpdatePayload $updatePayload): User;
}
