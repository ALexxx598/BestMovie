<?php

namespace App\Http\Resource\Collection;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Collection\MovieCollections;

/**
 * @mixin MovieCollections
 */
class CollectionListResource extends MovieMicroserviceResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'items' => CollectionResource::collection($this->getItems()),
            'temp' => [
                'current_page' => $this->getPage(),
                'last_page' => $this->getLastPage(),
                'per_page' => $this->getPerPage(),
                'total' => $this->getTotal(),
            ],
        ];
    }
}
