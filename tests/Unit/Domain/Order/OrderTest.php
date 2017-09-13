<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Order;

use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOnlyAllowsItemObjects()
    {
        $order = new Order(
            1,
            1,
            [
                new Item('A101', 1, new Price(5), new Price(5)),
                new Item('A102', 2, new Price(10), new Price(20)),
            ],
            new Price(25)
        );

        $this->assertCount(2, $order->getItems());
    }

    public function testDoesntAllowNonItemObjects()
    {
        $this->expectException(\TypeError::class);
        new Order(
            1,
            1,
            [
                'Foo'
            ],
            new Price(25)
        );
    }
}
