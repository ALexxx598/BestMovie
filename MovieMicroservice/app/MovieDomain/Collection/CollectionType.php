<?php

namespace App\MovieDomain\Collection;

use Spatie\Enum\Enum;

/**
 * @method static self CUSTOM()
 * @method static self DEFAULT()
 * @method static self TEST()
 */
class CollectionType extends Enum
{
    protected const CUSTOM = 'CUSTOM';
    protected const DEFAULT = 'DEFAULT';
    protected const TEST = 'TEST';
}
