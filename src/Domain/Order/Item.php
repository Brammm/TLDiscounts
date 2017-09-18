<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Brammm\TLDiscounts\Domain\Discount\Discount;
use Brammm\TLDiscounts\Domain\Price\Price;

class Item implements \JsonSerializable
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

    /**
     * @var Discount
     */
    private $discount;

    public function __construct(string $productId, int $quantity, Price $unitPrice, Price $total)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function addExtras(int $freeExtras): void
    {
        $this->quantity += $freeExtras;
    }

    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function getTotal(): Price
    {
        return $this->total;
    }

    public function setDiscount(Discount $discount): void
    {
        $this->discount = $discount;
    }

    public function jsonSerialize()
    {
        return [
            'product-id' => $this->productId,
            'quantity' => $this->quantity,
            'unit-price' => (string)$this->unitPrice,
            'total' => (string)$this->total,
            'applied-discount' => isset($this->discount) ? $this->discount->getName() : null,
        ];
    }
}
