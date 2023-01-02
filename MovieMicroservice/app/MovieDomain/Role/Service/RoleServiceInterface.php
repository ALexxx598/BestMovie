<?php

namespace App\MovieDomain\Role\Service;

use App\MovieDomain\Role\Role;

interface RoleServiceInterface
{
    /**
     * @param int $userId
     * @return Role
     */
    public function addAdminRole(int $userId): Role;

    /**
     * @param int $userId
     * @return Role
     */
    public function addViewerRole(int $userId): Role;
}
