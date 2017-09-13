<?php

namespace Brammm\TLDiscounts\Domain\Product;

class ProductNotFoundException extends \InvalidArgumentException
{
    public static function forId(string $id)
    {
        return new static(sprintf('Product with ID "%s" not found.', $id));
    }
}
