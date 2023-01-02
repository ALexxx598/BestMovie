<?php

namespace App\Http\Resource\User;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Role\Role;
use App\MovieDomain\User\User;

/**
 * @mixin User
 */
class UserResource extends MovieMicroserviceResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'roles' => $this
                ->getRoles()
                ?->map(function (Role $role) {
                    return $role->getRole()->value;
                })
                ->toArray(),
            'access_token' => $this->getAccessToken(),
            'create_date' => $this->getCreateDate()->format('Y-m-d H:i:s'),
        ];
    }
}
