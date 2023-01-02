<?php

namespace App\MovieDomain\User\Token;

use App\MovieDomain\User\User;

interface UserTokenServiceInterface
{
    /**
     * @param string $token
     * @return User
     */
    public function getUserByToken(string $token): User;
}
