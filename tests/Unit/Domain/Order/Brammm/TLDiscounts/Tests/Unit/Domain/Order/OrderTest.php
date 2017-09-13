<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Order;

use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Money\Money;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOnlyAllowsItemObjects()
    {
        $order = new Order(
            1,
            1,
            [
                new Item('A101', 1, Money::EUR(5), Money::EUR(5)),
                new Item('A102', 2, Money::EUR(10), Money::EUR(20)),
            ],
            Money::EUR(25)
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
            Money::EUR(25)
        );
    }
}
