<?php

namespace App\MovieDomain\Collection\Payload;

class CollectionCreatePayload
{
    /**
     * @param int $userId
     * @param string $name
     */
    private function __construct(
        private int $userId,
        private string $name,
    ) {
    }

    /**
     * @param int $userId
     * @param string $name
     * @return static
     */
    public static function make(
        int $userId,
        string $name,
    ): self {
        return new self(
            userId: $userId,
            name: $name
        );
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
