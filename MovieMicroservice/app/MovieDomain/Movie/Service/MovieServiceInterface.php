<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\MovieCollection;

interface MovieServiceInterface
{
    /**
     * @param MovieCreatePayload $payload
     * @return mixed
     */
    public function create(MovieCreatePayload $payload);

    /**
     * @param MovieFilter $filter
     * @return MovieCollection
     */
    public function list(MovieFilter $filter): MovieCollection;
}
