<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;

class MovieCreateRequest extends MovieMicroserviceRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'array',
            ],
            'storage_movie_link' => [
                'required',
                'string',
            ],
            'image_movie_link' => [
                'required',
                'string',
            ]
        ];
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
