<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Order;

class DiscountCalculator
{
    public function process(Order $order)
    {
        return $order;
    }
}
