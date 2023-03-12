<?php

namespace Tests\Unit\MovieDomain\Role;

use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;

trait RoleStubTrait
{
    /**
     * @param array $data
     * @return Role
     */
    public function makeRole(array $data = []): Role
    {
        $data = array_merge([
            'id' => $this->faker->numberBetween(),
            'userId' => $this->faker->numberBetween(),
            'roleType' => $this->faker->randomElement(RoleType::toArray())
        ], $data);

        return new Role(
            id: $data['id'],
            userId: $data['userId'],
            role: $data['roleType'],
        );
    }
}
