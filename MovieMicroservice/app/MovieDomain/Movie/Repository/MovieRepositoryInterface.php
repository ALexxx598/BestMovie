<?php

namespace App\MovieDomain\Movie\Repository;

use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\MovieCollection;

interface MovieRepositoryInterface
{
    /**
     * @param Movie $movie
     * @return int
     */
    public function save(Movie $movie): int;

    /**
     * @param MovieFilter $filter
     * @return MovieCollection
     */
    public function list(MovieFilter $filter): MovieCollection;
}
