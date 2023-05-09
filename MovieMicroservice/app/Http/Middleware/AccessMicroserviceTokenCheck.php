<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\UnauthorizedException;

class AccessMicroserviceTokenCheck
{
    public function __construct(
        private Config $config
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->config->get('MICROSERVICE_AUTH_TOKEN') !== $request->header('MICROSERVICE_AUTH')) {
           throw new UnauthorizedException();
        }

        return $next($request);
    }
}
