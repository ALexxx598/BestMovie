<?php

namespace App\MovieDomain\User\Payload;

use App\MovieDomain\User\User;

class UserPayloadToEntityMapper
{
    /**
     * @param UserCreatePayload $userPayload
     * @return User
     */
    public function mapCreatePayloadToEntity(UserCreatePayload $userPayload): User
    {
        return new User(
            name: $userPayload->getName(),
            surname: $userPayload->getSurname(),
            email: $userPayload->getEmail(),
            password: $userPayload->getPassword(),
        );
    }
}
