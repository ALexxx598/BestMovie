<?php

namespace App\MovieDomain\User\Payload;

class UserCreatePayload
{
    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private string $name,
        private string $surname,
        private string $email,
        private string $password
    ) {
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
}
