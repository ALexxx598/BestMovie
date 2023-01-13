<?php

namespace App\Http\Controllers;

use App\Http\Request\User\UserGetRequest;
use App\Http\Request\User\UserRegistrationRequest;
use App\Http\Request\User\UserRequest;
use App\Http\Request\User\UserUpdateRequest;
use App\Http\Resource\User\UserResource;
use Illuminate\Http\JsonResponse;
use App\MovieDomain\User\Payload\UserCreatePayload;
use App\MovieDomain\User\Payload\UserUpdatePayload;
use App\MovieDomain\User\Service\UserServiceInterface;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UserController
{
    /**
     * @param UserServiceInterface $userService
     * @param UserTokenServiceInterface $userTokenService
     */
    public function __construct(
        private UserServiceInterface $userService,
        private UserTokenServiceInterface $userTokenService
    ) {
    }

    /**
     * @param UserRegistrationRequest $request
     * @return JsonResponse
     */
    public function register(UserRegistrationRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => UserResource::make(
                    $this->userService->create(
                        new UserCreatePayload(
                            name: $request->getName(),
                            surname: $request->getSurname(),
                            email: $request->getEmail(),
                            password: $request->getUserPassword()
                        )
                    )
                ),
            ],
        );
    }

    /**
     * @param UserGetRequest $request
     * @return JsonResponse
     * @throws \App\MovieDomain\User\Exception\NonValidPasswordException
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function login(UserGetRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => UserResource::make(
                    $this->userService->getUserByEmailAndPassword(
                        $request->getEmail(),
                        $request->getUserPassword()
                    )
                ),
            ],
        );
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function refresh(UserRequest $request): JsonResponse
    {
        $user = $this->userTokenService->getUserByToken($request->getAuthHeader());

        if ($user->getId() !== $request->getUserId()) {
            throw new AccessDeniedException('You must be authorized!!!');
        }

        return response()->json([
            'data' => UserResource::make($user)
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function update(UserUpdateRequest $request): JsonResponse
    {
        return response()->json([
            'data' => UserResource::make(
                $this->userService->update(
                    new UserUpdatePayload(
                        id: $this->userTokenService->getUserByToken($request->getAuthHeader())->getId(),
                        name: $request->getName(),
                        surname: $request->getSurname()
                    )
                )
            ),
        ]);
    }
}
