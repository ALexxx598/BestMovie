<?php

namespace App\MovieDomain\Category\Payload;

class CategoryCreatePayload
{
    /**
     * @param string $name
     */
    private function __construct(
        private string $name,
    ) {
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function make(
        string $name,
    ): self {
        return new self(
            name: $name
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
