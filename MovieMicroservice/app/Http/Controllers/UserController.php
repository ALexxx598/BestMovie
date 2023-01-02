<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserGetRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;

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
     */
    public function getDetails(UserRequest $request): JsonResponse
    {
        return response()->json([
            'data' => UserResource::make($this->userTokenService->getUserByToken($request->getAuthHeader()))
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
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
