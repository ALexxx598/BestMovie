<?php

namespace App\MovieDomain\Movie\Repository;

use App\MovieDomain\Movie\Movie;

interface MovieRepositoryInterface
{
    /**
     * @param Movie $movie
     * @return int
     */
    public function save(Movie $movie): int;
}
