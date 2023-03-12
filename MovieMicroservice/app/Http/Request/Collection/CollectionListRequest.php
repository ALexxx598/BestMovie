<?php

namespace App\Http\Request\Collection;

use App\Common\MovieMicroserviceRequest;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Validation\Rule;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CollectionListRequest extends MovieMicroserviceRequest
{
    protected const PER_PAGE = 100;
    protected const PAGE = 1;

    public function rules(): array
    {
        return [
            'user_id' => [
                'nullable',
                'int',
            ],
//            'type' => [
//                'required',
//                'string',
//                Rule::in(CollectionType::toArray()),
//                function ($attribute, $value, $fail) {
//                    if (($value === CollectionType::CUSTOM()->value || $value === CollectionType::TEST()->value)
//                        && $this->input('user_id') === null
//                    ) {
//                        throw new AccessDeniedException('You must be authorized !!!');
//                    }
//                },
//            ],
            'collection_ids' => [
                'nullable',
                'array',
            ],
            'collection_ids.*' => [
                'int',
            ],
            'per_page' => [
                'nullable',
                'int',
            ],
            'page' => [
                'nullable',
                'int',
            ],
        ];
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->input('user_id');
    }

//    /**
//     * @return string|null
//     */
//    public function getType(): ?string
//    {
//        return $this->input('type');
//    }

    /**
     * @return array|null
     */
    public function getCollectionIds(): ?array
    {
        return $this->input('collection_ids');
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->input('page', self::PAGE);
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->input('per_page', self::PER_PAGE);
    }
}
