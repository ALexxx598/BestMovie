<?php

namespace Tests\Feature\MovieDomain;

use App\MovieDomain\Role\RoleType;
use Carbon\Carbon;
use Tests\ApiTestCase;
use Tests\Feature\MovieDomain\User\UserModelTrait;

/**
 * @covers \App\Http\Controllers\UserController
 */
class UserTest extends ApiTestCase
{
    use UserModelTrait;

    public function testRegister()
    {
        $response = $this->post('api/user/', [
            'name' => $name = $this->faker->word,
            'surname' => $surname = $this->faker->word,
            'password' => $password = 'Some123456',
            'password_confirmation' => $password,
            'email' => $email = $this->faker->email,
        ]);

        $response->assertStatus(200);
        $response->assertJson(
            [
                'data' => [
                    'id' => $response->json('data.id'),
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'roles' => [
                        RoleType::viewer()->value,
                    ],
                    'access_token' => $response->json('data.access_token'),
                    'create_date' => $response->json('data.create_date'),
                ],
            ]
        );
    }

    public function testGetDetails()
    {
        $user = $this->makeUser();

        $response = $this->get('api/user/detail', [
            'authorization' => $this->getUserToken($user),
        ]);

        $response->assertStatus(200);
        $response->assertJson(
            [
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'roles' => [],
                    'access_token' => $this->getUserToken($user),
                    'create_date' => Carbon::make($user->created_at),
                ],
            ]
        );
    }

    public function testLogin()
    {
        $user = $this->makeUser($password = 'Some123456');

        $response = $this->get('api/user/?' . http_build_query([
            'password' => $password,
            'email' => $user->email,
        ]));

        $response->assertStatus(200);
    }

    public function testToken()
    {
        $this->markTestIncomplete();

        $user = $this->makeUser($password = 'Some123456');

        $response = $this->get('api/test/?' . http_build_query(['user_id' => $user->id]), [
            'authorization' => $this->getUserToken($user),
        ]);

        $response->assertStatus(200);
    }
}
