<?php

namespace App\MovieDomain\User;

use App\MovieDomain\Role\Repository\RoleRepositoryFinderTrait;
use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;
use App\MovieDomain\User\Repository\UserRepositoryFinderTrait;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class User
{
    use UserRepositoryFinderTrait;
    use RoleRepositoryFinderTrait;

    /**
     * @param int|null $id
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     * @param Collection|null $roles
     * @param string|null $accessToken
     * @param Carbon|null $createDate
     */
    public function __construct(
        private ?int $id = null,
        private string $name,
        private string $surname,
        private string $email,
        private string $password,
        private ?Collection $roles = null,
        private ?string $accessToken = null,
        private ?Carbon $createDate = null,
    ) {
    }

    /**
     * @param string|null $accessToken
     * @return $this
     */
    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $surname
     * @return $this
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param Carbon|null $createDate
     * @return $this
     */
    public function setCreateDate(?Carbon $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Carbon|null
     */
    public function getCreateDate(): ?Carbon
    {
        return $this->createDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @return Collection|null
     */
    public function getRoles(): ?Collection
    {
        return $this->roles;
    }

    /**
     * @param RoleType $roleType
     * @return bool
     */
    public function hasRole(RoleType $roleType): bool
    {
        $roles = $this->getRoleRepository()->getRolesByUserId($this->getId());

        foreach ($roles as $role) {
            if ($roleType->equals($role->getRole())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role): void
    {
        if (!is_null($this->roles)) {
            $this->roles->add($role);
        } else {
            $this->roles = Collection::make([$role]);
        }
    }
}
