<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Payload\MovieCreatePayload;

interface MovieServiceInterface
{
    /**
     * @param MovieCreatePayload $payload
     * @return mixed
     */
    public function create(MovieCreatePayload $payload);
}
