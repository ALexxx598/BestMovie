<?php

namespace App\Http\Resource\Movie;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Movie\MovieCollection;

/**
 * @mixin MovieCollection
 */
class MovieListResource extends MovieMicroserviceResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'items' => MovieResource::collection($this->getItems()),
            'temp' => [
                'current_page' => $this->getPage(),
                'last_page' => $this->getLastPage(),
                'per_page' => $this->getPerPage(),
                'total' => $this->getTotal(),
            ],
        ];
    }
}
