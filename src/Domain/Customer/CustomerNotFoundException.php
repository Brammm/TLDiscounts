<?php

namespace Brammm\TLDiscounts\Domain\Customer;

class CustomerNotFoundException extends \InvalidArgumentException
{
    public static function forId(int $id)
    {
        return new static(sprintf('Customer with ID "%s" not found.', $id));
    }
}
