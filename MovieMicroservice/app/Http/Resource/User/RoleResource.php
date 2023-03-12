<?php

namespace App\Http\Resource\User;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Role\Role;

/**
 * @mixin Role
 */
class RoleResource extends MovieMicroserviceResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
           'name' => $this->getRole()->value,
        ];
    }
}
