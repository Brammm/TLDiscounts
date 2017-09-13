<?php

namespace Brammm\TLDiscounts\Domain\Product;

use MyCLabs\Enum\Enum;

/**
 * @method static self TOOL()
 * @method static self SWITCH()
 */
class Category extends Enum
{
    const TOOL = 1;
    const SWITCH = 2;
}
