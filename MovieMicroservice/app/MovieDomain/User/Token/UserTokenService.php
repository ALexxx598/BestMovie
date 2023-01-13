<?php

namespace App\MovieDomain\User\Token;

use App\MovieDomain\User\Service\UserServiceInterface;
use App\MovieDomain\User\User;

class UserTokenService implements UserTokenServiceInterface
{
    public function __construct(
        private UserTokenRepositoryInterface $tokenRepository,
        private UserServiceInterface $userService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getUserByToken(string $token): User
    {
        return $this->userService->findUser($this->tokenRepository->getUserByToken($token));
    }
}
