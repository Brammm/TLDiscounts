<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Money\Money;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var Item[]
     */
    private $items;

    /**
     * @var Money
     */
    private $total;

    public function __construct(int $id, int $customerId, array $items, Money $total)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->total = $total;
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    private function addItem(Item $item)
    {
        $this->items[] = $item;
    }
}
