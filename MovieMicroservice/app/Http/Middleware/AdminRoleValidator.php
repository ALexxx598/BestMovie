<?php

namespace App\Http\Middleware;

use App\Common\AuthMiddlewareTrait;
use App\MovieDomain\Role\RoleType;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AdminRoleValidator
{
    use AuthMiddlewareTrait;

    public function __construct(
        private UserTokenServiceInterface $userTokenService
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->userTokenService->getUserByToken($this->checkAuthToken($request))->hasRole(RoleType::admin())) {
            throw new AccessDeniedException('You must have admin role');
        }

        return $next($request);
    }
}
