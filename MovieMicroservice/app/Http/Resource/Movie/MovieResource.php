<?php

namespace App\Http\Resource\Movie;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Movie\Movie;

/**
 * @mixin Movie
 */
class MovieResource extends MovieMicroserviceResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'storage_image_url' => $this->getStorageImageUrl(),
            'storage_movie_url' => $this->getStorageMovieUrl(),
        ];
    }
}
