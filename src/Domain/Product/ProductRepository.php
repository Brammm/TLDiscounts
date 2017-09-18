<?php

namespace Brammm\TLDiscounts\Domain\Product;

interface ProductRepository
{
    /**
     * Save a product in the repository
     */
    public function save(Product $product): void;

    /**
     * Fetch a product from the repository by it's ID
     *
     * @throws ProductNotFoundException
     */
    public function findById(string $id): Product;
}
