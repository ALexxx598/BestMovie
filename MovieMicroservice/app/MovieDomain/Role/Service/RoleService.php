<?php

namespace App\MovieDomain\Role\Service;

use App\MovieDomain\Role\Repository\RoleRepositoryInterface;
use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;

class RoleService implements RoleServiceInterface
{
    /**
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
    }

    /**
     * @param int $userId
     * @return Role
     */
    public function addAdminRole(int $userId): Role
    {
        return $this->roleRepository->save($userId, RoleType::admin());
    }

    /**
     * @param int $userId
     * @return Role
     */
    public function addViewerRole(int $userId): Role
    {
        return $this->roleRepository->save($userId, RoleType::viewer());
    }
}
