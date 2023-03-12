<?php

namespace App\MovieDomain\Role;

class Role
{
    /**
     * @param int $id
     * @param int $userId
     * @param RoleType $role
     */
    public function __construct(
        private int $id,
        private int $userId,
        private RoleType $role
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return RoleType
     */
    public function getRole(): RoleType
    {
        return $this->role;
    }
}
