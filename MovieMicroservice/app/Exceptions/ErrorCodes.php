<?php

namespace App\Exceptions;

use Spatie\Enum\Enum;

/**
 * @method static self NON_VALID_PASSWORD()
 * @method static self NOT_FOUND()
 * @method static self CAN_NOT_REMOVE_MODEL()
 * @method static self INVALID_MOVIE_URL()
 * @method static self INVALID_IMAGE_URL()
 */
class ErrorCodes extends Enum
{
    public const NON_VALID_PASSWORD = '1010';
    public const NOT_FOUND = '1011';
    public const CAN_NOT_REMOVE_MODEL = '1012';

    public const INVALID_MOVIE_URL = '1110';
    public const INVALID_IMAGE_URL = '1111';
}
