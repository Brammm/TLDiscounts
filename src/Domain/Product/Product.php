<?php

namespace Brammm\TLDiscounts\Domain\Product;

use Brammm\TLDiscounts\Domain\Price\Price;

class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var Price
     */
    private $price;

    public function __construct(string $id, string $description, Category $category, Price $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
