<?php

namespace Brammm\TLDiscounts\Tests\Integration;

use Brammm\TLDiscounts\Domain\Price\Price;
use Brammm\TLDiscounts\Domain\Product\Category;
use Brammm\TLDiscounts\Domain\Product\ProductNotFoundException;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;
use Brammm\TLDiscounts\Tests\AppTestCase;

class ProductRepositoryTest extends AppTestCase
{
    public function testItFindsCustomer()
    {
        $product = $this->getContainer()->get(ProductRepository::class)->findById('A101');

        $this->assertSame('A101', $product->getId());
        $this->assertSame('Screwdriver', $product->getDescription());
        $this->assertEquals(Category::TOOL(), $product->getCategory());
        $this->assertEquals(new Price(9.75), $product->getPrice());
    }

    public function testItThrowsExceptionOnNotFound()
    {
        $this->expectException(ProductNotFoundException::class);

        $this->getContainer()->get(ProductRepository::class)->findById('foo');
    }
}
