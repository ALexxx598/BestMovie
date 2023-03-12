<?php

namespace App\Http\Resource\Category;

use App\Common\MovieMicroserviceResource;
use App\MovieDomain\Category\CategoryCollection;

/**
 * @mixin CategoryCollection
 */
class CategoryListResource extends MovieMicroserviceResource
{
    public function toArray($request): array
    {
        return [
            'items' => CategoryResource::collection($this->getItems()),
            'temp' => [
                'current_page' => $this->getPage(),
                'last_page' => $this->getLastPage(),
                'per_page' => $this->getPerPage(),
                'total' => $this->getTotal(),
            ],
        ];
    }
}
