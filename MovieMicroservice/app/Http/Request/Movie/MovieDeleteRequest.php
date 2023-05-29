<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;

class MovieDeleteRequest extends MovieMicroserviceRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->input('id');
    }
}
