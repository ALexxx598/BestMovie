<?php

namespace App\MovieDomain\User\Token;

use App\Models\PersonalAccessToken;
use App\MovieDomain\User\Exception\UserNotFoundException;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getUserByToken(string $token): int
    {
        /** * @var PersonalAccessToken $tokenModel */
        $tokenModel = PersonalAccessToken::query()->where('token', $token)->get()->first();

        if (is_null($tokenModel)) {
            throw new UserNotFoundException();
        }

        return $tokenModel->tokenable_id;
    }
}
