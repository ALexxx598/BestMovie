<?php

namespace App\MovieDomain\User\Payload;

class UserCreatePayload
{
    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     * @param string $emailConfirmationCode
     */
    private function __construct(
        private string $name,
        private string $surname,
        private string $email,
        private string $password,
        private string $emailConfirmationCode,
    ) {
    }

    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     * @param string $emailConfirmationCode
     * @return static
     */
    public static function make(
        string $name,
        string $surname,
        string $email,
        string $password,
        string $emailConfirmationCode,
    ): self {
        return new self(
           name: $name,
           surname: $surname,
           email: $email,
           password: $password,
           emailConfirmationCode: $emailConfirmationCode
        );
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
     * @return string
     */
    public function getEmailConfirmationCode(): string
    {
        return $this->emailConfirmationCode;
    }
}
