<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Money\Money;

class Item
{
    /**
     * @var string
     */
    private $productId;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Money
     */
    private $unitPrice;

    /**
     * @var Money
     */
    private $total;

    public function __construct(string $productId, int $quantity, Money $unitPrice, Money $total)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }
}
