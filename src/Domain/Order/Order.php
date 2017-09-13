<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Brammm\TLDiscounts\Domain\Price\Price;

class Order implements \JsonSerializable
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
     * @var Price
     */
    private $total;

    public function __construct(int $id, int $customerId, array $items, Price $total)
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

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): Price
    {
        return $this->total;
    }

    private function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'customer-id' => $this->customerId,
            'items' => $this->items,
            'total' => $this->total,
        ];
    }

    public function recalculateTotal()
    {
        $this->total = new Price(0);
        foreach ($this->items as $item) {
            $this->total->add($item->getTotal());
        }
    }
}
