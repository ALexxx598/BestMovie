<?php

namespace App\Http\Resources\User;

use App\Common\MovieMicroserviceResource;

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
