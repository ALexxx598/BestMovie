<?php

namespace App\MovieDomain\User\Repository;

use App\Models\User as UserModel;
use App\MovieDomain\User\Exception\NonValidPasswordException;
use App\MovieDomain\User\Exception\UserNotFoundException;
use App\MovieDomain\User\Hash\HashServiceInterface;
use App\MovieDomain\User\User;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param UserModelMapper $userRepositoryMapper
     * @param HashServiceInterface $hashService
     */
    public function __construct(
        private UserModelMapper      $userRepositoryMapper,
        private HashServiceInterface $hashService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): User
    {
        return $this->userRepositoryMapper->mapModelToEntity($this->getUserModel($id));
    }

    /**
     * @inheritDoc
     * @throws NonValidPasswordException
     * @throws UserNotFoundException
     */
    public function findByEmailAndPassword(string $email, string $password): User
    {
        $user = $this->findByEmail($email);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $this->checkPassword($user, $password);
    }

    /**
     * @param string $email
     * @return UserModel|null
     */
    private function findByEmail(string $email): ?UserModel
    {
        return UserModel::query()->where('email', $email)->with('roles')->get()->first();
    }

    /**
     * @param UserModel $user
     * @param string $password
     * @return User
     * @throws NonValidPasswordException
     */
    private function checkPassword(UserModel $user, string $password): User
    {
        if (!$this->hashService->check($password, $user->password)) {
            throw new NonValidPasswordException();
        }

        return $this->userRepositoryMapper->mapModelToEntity($user);
    }

    /**
     * @inheritDoc
     */
    public function save(User $user): int
    {
        $this->userRepositoryMapper->mapEntityToModel($user, $model = new UserModel());

        $model->exists = $model->id ?? false;
        $model->save();

        $user->setAccessToken($model->createToken('accessToken')->accessToken->token);
        $user->setCreateDate(Carbon::make($model->created_at));

        return $model->id;
    }

    /**
     * @inheritDoc
     */
    public function getUserModel(int $id): UserModel
    {
        if (is_null($user = UserModel::find($id))) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
