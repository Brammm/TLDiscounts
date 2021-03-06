<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Product\Category;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;

class BuyAmountGetExtra implements Discount
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * @var Category
     */
    private $category;
    /**
     * @var int
     */
    private $minimumQuantity;

    /**
     * @var int
     */
    private $freeExtra;

    public function __construct(ProductRepository $repository, Category $category, int $minimumQuantity, int $freeExtra)
    {
        $this->repository = $repository;
        $this->category = $category;
        $this->minimumQuantity = $minimumQuantity;
        $this->freeExtra = $freeExtra;
    }

    public function getName(): string
    {
        return sprintf('Buy%dGet%dExtra', $this->minimumQuantity, $this->freeExtra);
    }

    public function isApplicable(Order $order): bool
    {
        foreach ($order->getItems() as $item) {
            if ($this->isItemApplicable($item)) {
                return true;
            }
        }

        return false;
    }

    public function apply(Order $order): void
    {
        foreach ($order->getItems() as $item) {
            if ($this->isItemApplicable($item)) {
                $this->applyItem($item);
            }
        }
    }

    private function isItemApplicable(Item $item)
    {
        $product = $this->repository->findById($item->getProductId());

        if (!$product->getCategory()->equals($this->category)) {
            return false;
        }

        if ($item->getQuantity() < $this->minimumQuantity) {
            return false;
        }

        return true;
    }

    private function applyItem(Item $item)
    {
        $freeExtras = (int)(floor($item->getQuantity() / $this->minimumQuantity) * $this->freeExtra);

        $item->addExtras($freeExtras);
        $item->setDiscount($this);
    }
}
