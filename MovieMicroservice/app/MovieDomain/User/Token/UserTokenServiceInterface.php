<?php

namespace App\MovieDomain\User\Token;

use App\MovieDomain\User\Exception\UserNotFoundException;
use App\MovieDomain\User\User;

interface UserTokenServiceInterface
{
    /**
     * @param string $token
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByToken(string $token): User;
}
