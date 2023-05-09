<?php

namespace App\Common;

use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

trait AuthMiddlewareTrait
{
    /**
     * @param Request $request
     * @return string
     * @throws AccessDeniedException
     */
    public function checkAuthToken(Request $request): string
    {
        $token = $request->header('authorization');

        if ($token == null) {
            throw new AccessDeniedException('You must be authorized !!!');
        }

        return $token;
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getUserId(Request $request): int
    {
        $userId = $request->input('user_id');

        if ($userId === null) {
            throw new AccessDeniedException('You must be authorized !!!');
        }

        return $userId;
    }
}
