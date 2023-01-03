<?php

namespace App\MovieDomain\Movie\Repository;

use App\MovieDomain\Movie\Movie;
use App\Models\Movie as MovieModel;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function save(Movie $movie): int
    {
        $model = $this->mapEntityToModel($movie);

        $model->exists = $model->id ?? false;
        $model->save();

        return $model->id;
    }

    /**
     * @param Movie $movie
     * @return MovieModel
     */
    private function mapEntityToModel(Movie $movie): MovieModel
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
}
