<?php

namespace App\MovieDomain\Movie\Exception;

use App\Common\NotFoundException;

class MovieNotFound extends NotFoundException
{
    protected $message = 'Not found movie';
}
