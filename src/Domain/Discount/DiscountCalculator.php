<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Order;

class DiscountCalculator
{
    /**
     * @var Discount[]
     */
    private $discounts;

    public function __construct(array $discounts)
    {
        $this->discounts = $discounts;
    }

    /**
     * Process an order and apply all discounts that are available to the calculator
     */
    final public function process(Order $order)
    {
        foreach ($this->discounts as $discount) {
            if ($discount->isApplicable($order)) {
                $discount->apply($order);
            }
        }

        return $order;
    }
}
