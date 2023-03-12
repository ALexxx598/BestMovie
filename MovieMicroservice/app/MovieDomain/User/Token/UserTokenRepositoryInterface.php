<?php

namespace App\MovieDomain\User\Token;

use App\MovieDomain\User\Exception\UserNotFoundException;

interface UserTokenRepositoryInterface
{
    /**
     * @param string $token
     * @return int
     * @throws UserNotFoundException
     */
    public function getUserByToken(string $token): int;
}
