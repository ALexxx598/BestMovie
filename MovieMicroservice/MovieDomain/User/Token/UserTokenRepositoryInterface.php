<?php

namespace App\MovieDomain\User\Token;

interface UserTokenRepositoryInterface
{
    /**
     * @param string $token
     * @return int
     */
    public function getUserByToken(string $token): int;
}
