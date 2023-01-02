<?php

namespace Tests\Unit\MovieDomain\User;

use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;
use App\MovieDomain\Role\Service\RoleServiceInterface;
use App\MovieDomain\User\Payload\UserCreatePayload;
use App\MovieDomain\User\Payload\UserPayloadToEntityMapper;
use App\MovieDomain\User\Payload\UserUpdatePayload;
use App\MovieDomain\User\Repository\UserRepositoryInterface;
use App\MovieDomain\User\Service\UserService;
use App\MovieDomain\User\Service\UserServiceInterface;
use App\MovieDomain\User\User;
use Tests\UnitTestCase;
use Mockery as m;

class UserServiceTest extends UnitTestCase
{
    use UserStubTrait;

    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * @var RoleServiceInterface
     */
    private RoleServiceInterface $roleService;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService(
            $this->userRepository = m::mock(UserRepositoryInterface::class),
            new UserPayloadToEntityMapper(),
            $this->roleService = m::mock(RoleServiceInterface::class)
        );
    }

    public function testGetUser()
    {
        $this->userRepository
            ->shouldReceive('getById')
            ->once()
            ->andReturn($user = m::mock(User::class));

        $result = $this->userService->getUser($this->faker->numberBetween(1, 9999));

        $this->assertEquals($user, $result);
        $this->assertInstanceOf(User::class, $result);
    }

    public function testGetUserByEmailAndPassword()
    {
        $this->userRepository
            ->shouldReceive('findByEmailAndPassword')
            ->once()
            ->andReturn($user = m::mock(User::class));

        $result = $this->userService->getUserByEmailAndPassword($this->faker->email(), $this->faker->password);

        $this->assertEquals($user, $result);
        $this->assertInstanceOf(User::class, $result);
    }

    public function testHasRole()
    {
        $this->userRepository
            ->shouldReceive('getById')
            ->once()
            ->andReturn($user = m::mock(User::class, [
                'hasRole' => true,
            ]));

        $result = $this->userService->hasRole(
            $this->faker->numberBetween(1, 999),
            RoleType::viewer(),
        );

        $this->assertTrue($result);
    }

    public function testCreate()
    {
        $this->userRepository
            ->shouldReceive('save')
            ->once()
            ->andReturn($userId = $this->faker->numberBetween(1, 999));
        $this->roleService
            ->shouldReceive('addViewerRole')
            ->once()
            ->andReturn(m::mock(Role::class));

        $result = $this->userService->create(
            m::mock(UserCreatePayload::class, [
                'getName' => $name = $this->faker->numberBetween(1, 999),
                'getSurname' => $surname = $this->faker->numberBetween(1, 999),
                'getPassword' => $password = $this->faker->password,
                'getEmail' => $email = $this->faker->email(),
            ])
        );

        $this->assertEquals($userId, $result->getId());
        $this->assertEquals($name, $result->getName());
        $this->assertEquals($surname, $result->getSurname());
        $this->assertEquals($password, $result->getPassword());
        $this->assertEquals($email, $result->getEmail());
        $this->assertInstanceOf(User::class, $result);
    }

    public function testUpdate()
    {
        $this->userRepository
            ->shouldReceive('getById')
            ->once()
            ->andReturn($user = m::mock(User::class));
        $user->shouldReceive('setName')->once()->andReturnSelf();
        $user->shouldReceive('setSurname')->once()->andReturnSelf();
        $user->shouldReceive('setId')->once()->andReturnSelf();

        $this->userRepository
            ->shouldReceive('save')
            ->once()
            ->andReturn($userId = $this->faker->numberBetween(1, 999));

        $result = $this->userService->update(
            m::mock(UserUpdatePayload::class, [
                'getName' => $this->faker->numberBetween(1, 999),
                'getSurname' => $this->faker->numberBetween(1, 999),
                'getId' => $userId,
            ])
        );

        $this->assertInstanceOf(User::class, $result);
    }
}
