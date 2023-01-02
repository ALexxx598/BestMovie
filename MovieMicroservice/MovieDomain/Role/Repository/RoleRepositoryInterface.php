<?php

namespace App\MovieDomain\Role\Repository;

use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    /**
     * @param int $userId
     * @param RoleType $customer
     * @return Role
     */
    public function save(int $userId, RoleType $customer): Role;

    /**
     * @param int $userId
     * @return Collection<Role>
     */
    public function getRolesByUserId(int $userId): Collection;
}
