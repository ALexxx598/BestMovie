<?php

namespace Tests\Feature\MovieDomain\User;

use App\Models\Role;
use App\Models\User;
use App\MovieDomain\Role\RoleType;
use Illuminate\Support\Facades\Hash;

trait UserModelTrait
{
    /**
     * @param string|null $password
     * @param RoleType|null $role
     * @return User
     */
    public function makeUser(?string $password = null, ?RoleType $role = null): User
    {
        $user = User::factory(1)
            ->create([
                'password' => Hash::make($password ?? $this->faker->randomNumber(1, 99999)),
            ])
            ->first();
        $user
            ->tokens()
            ->create([
                'name' => 'accessToken',
                'token' => 'imagine that this is token'
                    . $this->faker->name
                    . $this->faker->numberBetween(1, 9999)
            ]);
        $user
            ->roles()
            ->create(['role' => $role ?? RoleType::admin()->value]);

        return $user;
    }

    /**
     * @param int $count
     * @return array
     */
    public function makeUsers(int $count = 3): array
    {
        $users = [];

        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->makeUser();
        }

        return $users;
    }

    /**
     * @param User $user
     * @return array
     *
     */
    public function getUserRoles(User $user): array
    {
        return $user->roles()->get()->map(fn (Role $role): string => $role->role)->toArray();
    }

    /**
     * @param User $user
     * @return string
     */
    public function getUserToken(User $user): string
    {
        return $user->tokens()->first()->token;
    }
}
