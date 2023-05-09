<?php

namespace App\MovieDomain\Collection\Exception;

use App\Common\NotFoundException;

class CollectionNotFound extends NotFoundException
{
    protected $message = 'Not found movie collection.';
}
