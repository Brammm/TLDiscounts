<?php

namespace Brammm\TLDiscounts\Domain\Product;

interface ProductRepository
{
    public function save(Product $product);

    public function findById(string $id): Product;
}
