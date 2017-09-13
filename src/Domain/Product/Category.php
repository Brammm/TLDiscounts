<?php

namespace Brammm\TLDiscounts\Domain\Product;

use Eloquent\Enumeration\AbstractEnumeration;

class Category extends AbstractEnumeration
{
    const TOOL = 1;
    const SWITCH = 2;
}
