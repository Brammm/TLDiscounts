<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Discount;

use Brammm\TLDiscounts\Domain\Discount\DiscountCheapestProductInCategory;
use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;
use Brammm\TLDiscounts\Domain\Product\Category;
use Brammm\TLDiscounts\Domain\Product\Product;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class DiscountCheapestInCategoryTest extends TestCase
{
    /**
     * @var ProductRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private $repo;

    /**
     * @var DiscountCheapestProductInCategory
     */
    private $discount;

    public function setUp()
    {
        $this->repo = $this->createMock(ProductRepository::class);
        $this->discount = new DiscountCheapestProductInCategory($this->repo, Category::SWITCH(), 2, 20);
    }

    public function testItIsApplicable()
    {
        $this->repo->expects($this->exactly(2))
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::SWITCH(),
                new Price(10)
            ));

        $order = $this->getApplicableOrder();

        $this->assertTrue($this->discount->isApplicable($order));
    }

    public function testItIsntApplicableWithMissingItems()
    {
        $this->repo->expects($this->once())
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::TOOL(),
                new Price(10)
            ));

        $order = new Order(
            1,
            1,
            [
                new Item(
                    'foo',
                    1,
                    new Price(10),
                    new Price(10)
                ),
            ],
            new Price(60)
        );

        $this->assertFalse($this->discount->isApplicable($order));
    }

    public function testItIsntApplicableWithIncorrectCategory()
    {
        $this->repo->expects($this->exactly(2))
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::TOOL(),
                new Price(10)
            ));

        $order = new Order(
            1,
            1,
            [
                new Item(
                    'foo',
                    1,
                    new Price(10),
                    new Price(10)
                ),
                new Item(
                    'foo',
                    1,
                    new Price(50),
                    new Price(50)
                ),
            ],
            new Price(60)
        );

        $this->assertFalse($this->discount->isApplicable($order));
    }

    public function testItAppliesDiscount()
    {
        $this->repo->expects($this->exactly(2))
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::SWITCH(),
                new Price(10)
            ));

        $order = $this->getApplicableOrder();

        $this->discount->apply($order);

        $this->assertEquals(new Price(8), $order->getItems()[0]->getTotal());
        $this->assertEquals(new Price(58), $order->getTotal());
    }

    private function getApplicableOrder()
    {
        return new Order(
            1,
            1,
            [
                new Item(
                    'foo',
                    1,
                    new Price(10),
                    new Price(10)
                ),
                new Item(
                    'foo',
                    1,
                    new Price(50),
                    new Price(50)
                ),
            ],
            new Price(60)
        );
    }
}
