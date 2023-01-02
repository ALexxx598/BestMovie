<?php

namespace App\MovieDomain\User\Repository;

use App\Models\User as UserModel;
use App\MovieDomain\Role\Repository\RoleRepositoryMapper;
use App\MovieDomain\User\Hash\HashServiceInterface;
use App\MovieDomain\User\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserModelMapper
{
    /**
     * @param HashServiceInterface $hashService
     * @param RoleRepositoryMapper $roleRepositoryMapper
     */
    public function __construct(
        private HashServiceInterface $hashService,
        private RoleRepositoryMapper $roleRepositoryMapper,
    ) {
    }

    /**
     * @param User $user
     * @param UserModel $model
     * @return void
     */
    public function mapEntityToModel(User $user, UserModel $model): void
    {
        $model->name = $user->getName();
        $model->surname = $user->getSurname();
        $model->password = $this->hashService->makeHash($user->getPassword());
        $model->email = $user->getEmail();

        if ($user->getId()) {
            $model->id = $user->getId();
        }
    }

    /**
     * @param UserModel $model
     * @return User
     */
    public function mapModelToEntity(UserModel $model): User
    {
        return new User(
            id: $model->id,
            name: $model->name,
            surname: $model->surname,
            email: $model->email,
            password: $model->password,
            roles: $this->roleRepositoryMapper->mapModelsToEntities($model->roles()->getEager()),
            accessToken: $model->tokens()->get()->first()->token,
            createDate: Carbon::make($model->created_at),
        );
    }

    /**
     * @param Collection<User> $models
     * @return Collection
     */
    public function mapModelsToEntities(Collection $models): Collection
    {
        return $models->map(fn (UserModel $user) => $this->mapModelToEntity($user));
    }
}
