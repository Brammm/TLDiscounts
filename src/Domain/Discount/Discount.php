<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Order;

interface Discount
{
    public function getName(): string;

    public function isApplicable(Order $order): bool;

    public function apply(Order $order);
}
