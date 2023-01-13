<?php

namespace App\Http\Resource\Movie;

use App\Common\MovieMicroserviceResource;
use App\Http\Resource\Category\CategoryResource;
use App\MovieDomain\Category\Category;
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
            'description' => [
                'screening_date' => $this->getDescription()->getScreeningDate()?->format('Y-m-d'),
                'short_description' => $this->getDescription()->getShortDescription(),
                'rating' => $this->getDescription()->getRating(),
                'actors' => $this->getDescription()->getActors(),
                'slogan' => $this->getDescription()->getSlogan(),
                'country' => $this->getDescription()->getCountry(),
            ],
            'categories' => CategoryResource::collection($this->getCategories()),
            'storage_image_url' => $this->getStorageImageUrl(),
            'storage_movie_url' => $this->getStorageMovieUrl(),
        ];
    }
}
