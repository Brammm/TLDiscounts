<?php

namespace Brammm\TLDiscounts\Application\Product;

use Brammm\TLDiscounts\Domain\Product\Product;
use Brammm\TLDiscounts\Domain\Product\ProductNotFoundException;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var Product[]
     */
    private $products = [];

    public function save(Product $product)
    {
        $this->products[$product->getId()] = $product;
    }

    public function findById(string $id): Product
    {
        if (isset($this->$products[$id])) {
            return $this->products[$id];
        }

        throw ProductNotFoundException::forId($id);
    }
}
