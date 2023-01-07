<?php

namespace App\MovieDomain\Movie\Repository;

use App\Models\Movie as MovieModel;
use App\MovieDomain\Category\Repository\CategoryModelMapper;
use App\MovieDomain\Movie\Movie;
use Illuminate\Support\Collection;

class MoveModelMapper
{
    /**
     * @param CategoryModelMapper $categoryModelMapper
     */
    public function __construct(
        private CategoryModelMapper $categoryModelMapper,
    ) {
    }

    /**
     * @param Movie $movie
     * @return MovieModel
     */
    public function mapEntityToModel(Movie $movie): MovieModel
    {
        $movieModel = new MovieModel();

        $movieModel->name = $movie->getName();
        $movieModel->description = json_encode($movie->getDescription());
        $movieModel->storage_image_link = $movie->getStorageImageUrl();
        $movieModel->storage_movie_link = $movie->getStorageMovieUrl();

        if ($movie->getId() !== null) {
            $movieModel->id = $movie->getId();
        }

        return $movieModel;
    }

    /**
     * @param MovieModel $movieModel
     * @return Movie
     */
    public function mapModelToEntity(MovieModel $movieModel): Movie
    {
        $movie = new Movie(
            id: $movieModel->id,
            name: $movieModel->name,
            description: json_decode($movieModel->description, true),
            storageMovieUrl: $movieModel->storage_movie_link,
            storageImageUrl: $movieModel->storage_image_link,
        );

        if ($movieModel->relationLoaded('categories')) {
            $movie->setCategories($this->categoryModelMapper->mapModelsToEntities($movieModel->categories));
        }

        return $movie;
    }

    /**
     * @param Collection<MovieModel> $models
     * @return Collection
     */
    public function mapModelsToEntities(Collection $models): Collection
    {
        return $models->map(fn (MovieModel $movie): Movie => $this->mapModelToEntity($movie));
    }
}
