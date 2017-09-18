<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Order;

interface Discount
{
    /**
     * Return a human readable name for the discount
     */
    public function getName(): string;

    /**
     * Wether or not the discount is applicable to the order
     */
    public function isApplicable(Order $order): bool;

    /**
     * Apply the discount to an order
     */
    public function apply(Order $order): void;
}
