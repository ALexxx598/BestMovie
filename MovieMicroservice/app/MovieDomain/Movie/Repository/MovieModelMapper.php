<?php

namespace App\MovieDomain\Movie\Repository;

use App\Models\Movie as MovieModel;
use App\MovieDomain\Category\Repository\CategoryModelMapper;
use App\MovieDomain\Collection\Repository\CollectionModelMapper;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\MovieDescription;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MovieModelMapper
{
    /**
     * @param CategoryModelMapper $categoryModelMapper
//     * @param CollectionModelMapper $collectionModelMapper
     */
    public function __construct(
        private CategoryModelMapper $categoryModelMapper,
//        private CollectionModelMapper $collectionModelMapper,
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

        $movieModel->description = json_encode([
            'screeningDate' => $movie->getDescription()->getScreeningDate()?->format('Y-m-d H:i:s'),
            'shortDescription' => $movie->getDescription()->getShortDescription(),
            'rating' => $movie->getDescription()->getRating(),
            'actors' => $movie->getDescription()->getActors(),
            'slogan' => $movie->getDescription()->getSlogan(),
            'country' => $movie->getDescription()->getCountry(),
        ]);

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
        $description = json_decode($movieModel->description, true);

        $movie = new Movie(
            id: $movieModel->id,
            name: $movieModel->name,
            description: new MovieDescription(
                rating: $description['rating'] ?? null,
                slogan: $description['slogan'] ?? null,
                screeningDate: ($description['screeningDate'] ?? null) !== null
                    ? Carbon::make($description['screeningDate'])
                    : null,
                country: $description['country'] ?? null,
                actors: $description['actors'] ?? null,
                shortDescription: $description['shortDescription']?? null
            ),
            storageMovieUrl: $movieModel->storage_movie_link,
            storageImageUrl: $movieModel->storage_image_link,
        );

        if ($movieModel->relationLoaded('categories')) {
            $movie->setCategories($this->categoryModelMapper->mapModelsToEntities($movieModel->categories));
        }

//        if ($movieModel->relationLoaded('collections')) {
//            $movie->seCollections($this->collectionModelMapper->mapModelsToEntities($movieModel->collections));
//        }

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
