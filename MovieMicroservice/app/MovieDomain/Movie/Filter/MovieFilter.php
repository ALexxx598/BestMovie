<?php

namespace App\MovieDomain\Movie\Filter;

class MovieFilter
{
    /**
     * @param int $page
     * @param int $perPage
     */
    public function __construct(
        private int $page,
        private int $perPage,
    ) {
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return static
     */
    public static function make(
        int $page,
        int $perPage,
    ): self {
        return new self(
            page: $page,
            perPage: $perPage
        );
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
