<?php

namespace App\Http\Middleware;

use App\Common\AuthMiddlewareTrait;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AccessTokenCheck
{
    use AuthMiddlewareTrait;

    /**
     * @param UserTokenServiceInterface $userTokenService
     */
    public function __construct(
        private UserTokenServiceInterface $userTokenService
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     * @throws AccessDeniedException
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->userTokenService->getUserByToken($this->checkAuthToken($request));

        if ($user->getId() !== (int)$request->input('user_id')) {
            throw new AccessDeniedException('You must be authorized !!!');
        }

        return $next($request);
    }
}
