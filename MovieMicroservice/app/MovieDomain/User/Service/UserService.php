<?php

namespace App\MovieDomain\User\Service;

use App\MovieDomain\Role\RoleType;
use App\MovieDomain\Role\Service\RoleServiceInterface;
use App\MovieDomain\User\Payload\UserCreatePayload;
use App\MovieDomain\User\Payload\UserPayloadToEntityMapper;
use App\MovieDomain\User\Payload\UserUpdatePayload;
use App\MovieDomain\User\Repository\UserRepositoryInterface;
use App\MovieDomain\User\User;

class UserService implements UserServiceInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserPayloadToEntityMapper $mapper
     * @param RoleServiceInterface $roleService
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserPayloadToEntityMapper $mapper,
        private RoleServiceInterface $roleService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getUser(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function getUserByEmailAndPassword(string $email, string $password): User
    {
        return $this->userRepository->findByEmailAndPassword($email, $password);
    }

    /**
     * @inheritDoc
     */
    public function hasRole(int $id, RoleType $roleType): bool
    {
        return $this->getUser($id)->hasRole($roleType);
    }

    /**
     * @inheritDoc
     */
    public function create(UserCreatePayload $userPayload): User
    {
        $user = $this->mapper->mapCreatePayloadToEntity($userPayload);

        $user->setId($this->userRepository->save($user));

        $user->addRole($this->roleService->addViewerRole($user->getId()));

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function update(UserUpdatePayload $updatePayload): User
    {
        $user = $this->getUser($updatePayload->getId());

        if (!is_null($updatePayload->getName())) {
            $user->setName($updatePayload->getName());
        }

        if (!is_null($updatePayload->getSurname())) {
            $user->setSurname($updatePayload->getSurname());
        }

        return $user->setId($this->userRepository->save($user));
    }
}
