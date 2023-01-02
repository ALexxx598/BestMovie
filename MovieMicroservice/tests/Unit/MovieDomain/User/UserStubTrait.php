<?php

namespace Tests\Unit\MovieDomain\User;

use App\MovieDomain\User\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\Unit\MovieDomain\Role\RoleStubTrait;

trait UserStubTrait
{
    use RoleStubTrait;

    /**
     * @param array $data
     * @return User
     */
    public function makeUser(array $data = []): User
    {
        $data = array_merge([
            'id' => $id = $this->faker->randomNumber(),
            'name' => $this->faker->name,
            'surname' =>  $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'roles' => Collection::make($this->makeRole(['userId' => $id])),
            'accessToken' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'createDate' => Carbon::now(),
        ], $data);

        return new User(
            id: $data['id'],
            name: $data['name'],
            surname: $data['surname'],
            email: $data['email'],
            password: $data['password'],
            roles: $data['roles'],
            accessToken: $data['accessToken'],
            createDate: $data['createdDate']
        );
    }
}
