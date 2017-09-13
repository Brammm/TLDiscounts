<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Discount;

use Brammm\TLDiscounts\Domain\Discount\BuyAmountGetExtra;
use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;
use Brammm\TLDiscounts\Domain\Product\Category;
use Brammm\TLDiscounts\Domain\Product\Product;
use Brammm\TLDiscounts\Domain\Product\ProductRepository;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class BuyAmountGetExtraTest extends TestCase
{
    /**
     * @var ProductRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private $repo;

    /**
     * @var BuyAmountGetExtra
     */
    private $discount;

    public function setUp()
    {
        $this->repo = $this->createMock(ProductRepository::class);

        $this->discount = new BuyAmountGetExtra($this->repo, Category::SWITCH(), 5, 1);
    }

    public function testItIsApplicable()
    {
        $this->repo->expects($this->once())
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::SWITCH(),
                new Price(10)
            ));

        $this->assertTrue($this->discount->isApplicable($this->getOrder()));
    }

    public function testItIsntApplicableInDifferentCategory()
    {
        $this->repo->expects($this->once())
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::TOOL(),
                new Price(10)
            ));

        $this->assertFalse($this->discount->isApplicable($this->getOrder()));
    }

    public function testItIsntApplicableWithFewerItems()
    {
        $this->repo->expects($this->once())
            ->method('findById')
            ->willReturn(new Product(
                'foo',
                'Foo',
                Category::SWITCH(),
                new Price(10)
            ));

        $this->assertFalse($this->discount->isApplicable($this->getOrder(4)));
    }

    /**
     * @dataProvider quantityProvider
     */
        public function testItAppliesDiscount($quantity, $discountQuantity)
        {
            $this->repo->expects($this->once())
                ->method('findById')
                ->willReturn(new Product(
                    'foo',
                    'Foo',
                    Category::SWITCH(),
                    new Price(10)
                ));

            $order = $this->getOrder($quantity);

            $this->discount->apply($order);

            $this->assertEquals($discountQuantity, $order->getItems()[0]->getQuantity());
        }

    public function quantityProvider()
    {
        return [
            [4, 4],
            [5, 6],
            [7, 8],
            [10, 12],
            [11, 13],
        ];
   }

    private function getOrder(int $itemQuantity = 5)
    {
        return new Order(
            1,
            1,
            [
                new Item(
                    'foo',
                    $itemQuantity,
                    new Price(10),
                    new Price(50)
                ),
            ],
            new Price(10)
        );
    }
}
