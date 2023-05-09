<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;
use Carbon\Carbon;

class MovieCreateRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'int',
            ],
            'name' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'array',
            ],
            'description.rating' => [
                'numeric'
            ],
            'description.slogan' => [
                'string'
            ],
            'description.screening_date' => [
                'string',
//                'date',//TODO add validation
            ],
            'description.country' => [
                'string', //Todo maybe add validation on country
            ],
            'description.actors' => [
                'string',
            ],
            'description.shortDescription' => [
                'string',
            ],
            'storage_movie_link' => [
                'required',
                'string',
            ],
            'storage_image_link' => [
                'required',
                'string',
            ]
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->input('description');
    }

    /**
     * @return string|null
     */
    public function getDescriptionRating(): ?string
    {
        return $this->input('description.rating');
    }

    /**
     * @return string|null
     */
    public function getDescriptionSlogan(): ?string
    {
        return $this->input('description.slogan');
    }

    /**
     * @return Carbon|null
     */
    public function getDescriptionScreeningDate(): ?Carbon
    {
        $date =  $this->input('description.screening_date');

        return $date !== null ? Carbon::make($date) : null;
    }

    /**
     * @return string|null
     */
    public function getDescriptionCountry(): ?string
    {
        return $this->input('description.country');
    }

    /**
     * @return string|null
     */
    public function getDescriptionActors(): ?string
    {
        return $this->input('description.actors');
    }

    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->input('description.shortDescription');
    }

    /**
     * @return string
     */
    public function getStorageMovieLink(): string
    {
        return $this->input('storage_movie_link');
    }

    /**
     * @return string
     */
    public function getStorageImageLink(): string
    {
        return $this->input('storage_image_link');
    }
}
