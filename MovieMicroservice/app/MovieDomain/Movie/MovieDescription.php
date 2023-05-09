<?php

namespace App\MovieDomain\Movie;

use Carbon\Carbon;

class MovieDescription
{
    /**
     * @param string|null $rating
     * @param string|null $slogan
     * @param Carbon|null $screeningDate
     * @param string|null $country
     * @param string|null $actors
     * @param string|null $shortDescription
     */
    public function __construct(
        private ?string $rating = null,
        private ?string $slogan = null,
        private ?Carbon $screeningDate = null,
        private ?string $country = null,
        private ?string $actors = null,
        private ?string $shortDescription = null,
    ) {
    }

    /**
     * @return string|null
     */
    public function getRating(): ?string
    {
        return $this->rating;
    }

    /**
     * @return string|null
     */
    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    /**
     * @return Carbon|null
     */
    public function getScreeningDate(): ?Carbon
    {
        return $this->screeningDate;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getActors(): ?string
    {
        return $this->actors;
    }

    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }
}
