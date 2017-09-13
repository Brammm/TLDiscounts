<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Brammm\TLDiscounts\Domain\Price\Price;

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
     * @var Price
     */
    private $unitPrice;

    /**
     * @var Price
     */
    private $total;

    public function __construct(string $productId, int $quantity, Price $unitPrice, Price $total)
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

    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function getTotal(): Price
    {
        return $this->total;
    }
}
