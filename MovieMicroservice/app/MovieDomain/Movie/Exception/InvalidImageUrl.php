<?php

namespace App\MovieDomain\Movie\Exception;

use Exception;

class InvalidImageUrl extends Exception
{
    protected $message = 'Invalid image url.';
}
