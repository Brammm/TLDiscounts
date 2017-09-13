<?php

namespace Brammm\TLDiscounts\Domain\Product;

class ProductNotFoundException extends \InvalidArgumentException
{
    public static function forId(int $id)
    {
        return new static(sprintf('Product with ID "%s" not found.', $id));
    }
}
