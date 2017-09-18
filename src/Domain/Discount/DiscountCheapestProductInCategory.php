<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Product\Category;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;

class DiscountCheapestProductInCategory implements Discount
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
    private $requiredItems;

    /**
     * @var int
     */
    private $percentageDiscount;

    public function __construct(ProductRepository $repository, Category $category, int $requiredItems, int $percentageDiscount)
    {
        $this->repository = $repository;
        $this->category = $category;
        $this->requiredItems = $requiredItems;
        $this->percentageDiscount = $percentageDiscount;
    }
    
    public function getName(): string
    {
        return sprintf('%dOffCheapest', $this->percentageDiscount);
    }

    public function isApplicable(Order $order): bool
    {
        $productCounter = 0;
        foreach ($order->getItems() as $item) {
            $product = $this->repository->findById($item->getProductId());
            if ($product->getCategory()->equals($this->category)) {
                $productCounter++;
            }
        }

        return $productCounter >= $this->requiredItems;
    }

    public function apply(Order $order): void
    {
        $cheapestItem = null;
        $cheapestProduct = null;
        foreach ($order->getItems() as $item) {
            $product = $this->repository->findById($item->getProductId());
            if ($product->getCategory()->equals($this->category)) {
                if (null === $cheapestItem) {
                    $cheapestItem = $item;
                    $cheapestProduct = $product;
                    continue;
                }

                if ($product->getPrice()->lowerThan($cheapestProduct->getPrice())) {
                    $cheapestProduct = $product;
                    $cheapestItem = $item;
                }
            }
        }

        $this->applyItem($cheapestItem);
        $order->recalculateTotal();
    }

    private function applyItem(Item $item)
    {
        $item->getTotal()->applyDiscountPercentage(20);
        $item->setDiscount($this);
    }
}
