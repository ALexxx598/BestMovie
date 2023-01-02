<?php

namespace App\MovieDomain\User\Payload;

class UserUpdatePayload
{
    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $surname
     */
    public function __construct(
        private int $id,
        private ?string $name,
        private ?string $surname,
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }
}
