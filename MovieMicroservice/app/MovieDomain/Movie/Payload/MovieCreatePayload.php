<?php

namespace App\MovieDomain\Movie\Payload;

use Carbon\Carbon;

class MovieCreatePayload
{
    /**
     * @param string $name
     * @param string|null $descriptionRating
     * @param string|null $descriptionSlogan
     * @param Carbon|null $descriptionScreeningDate
     * @param string|null $descriptionCountry
     * @param string|null $descriptionActors
     * @param string|null $shortDescription
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     */
    private function __construct(
        private string $name,
        private ?string $descriptionRating = null,
        private ?string $descriptionSlogan = null,
        private ?Carbon $descriptionScreeningDate = null,
        private ?string $descriptionCountry = null,
        private ?string $descriptionActors = null,
        private ?string $shortDescription = null,
        private string $storageMovieUrl,
        private string $storageImageUrl,
    ) {
    }

    /**
     * @param string $name
     * @param string|null $descriptionRating
     * @param string|null $descriptionSlogan
     * @param Carbon|null $descriptionScreeningDate
     * @param string|null $descriptionCountry
     * @param string|null $descriptionActors
     * @param string|null $shortDescription
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     * @return static
     */
    public static function make(
        string $name,
        ?string $descriptionRating = null,
        ?string $descriptionSlogan = null,
        ?Carbon $descriptionScreeningDate = null,
        ?string $descriptionCountry = null,
        ?string $descriptionActors = null,
        ?string $shortDescription = null,
        string $storageMovieUrl,
        string $storageImageUrl,
    ): self {
        return new self(
            name: $name,
            descriptionRating: $descriptionRating,
            descriptionSlogan: $descriptionSlogan,
            descriptionScreeningDate:  $descriptionScreeningDate,
            descriptionCountry:  $descriptionCountry,
            descriptionActors:  $descriptionActors,
            shortDescription:  $shortDescription,
            storageMovieUrl: $storageMovieUrl,
            storageImageUrl: $storageImageUrl
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescriptionRating(): ?string
    {
        return $this->descriptionRating;
    }

    /**
     * @return string|null
     */
    public function getDescriptionSlogan(): ?string
    {
        return $this->descriptionSlogan;
    }

    /**
     * @return Carbon|null
     */
    public function getDescriptionScreeningDate(): ?Carbon
    {
        return $this->descriptionScreeningDate;
    }

    /**
     * @return string|null
     */
    public function getDescriptionCountry(): ?string
    {
        return $this->descriptionCountry;
    }

    /**
     * @return string|null
     */
    public function getDescriptionActors(): ?string
    {
        return $this->descriptionActors;
    }

    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @return string
     */
    public function getStorageMovieUrl(): string
    {
        return $this->storageMovieUrl;
    }

    /**
     * @return string
     */
    public function getStorageImageUrl(): string
    {
        return $this->storageImageUrl;
    }
}
