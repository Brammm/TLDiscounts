<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Order;

use Brammm\TLDiscounts\Domain\Price\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /**
     * @dataProvider priceProvider
     */
    public function testItFormatsToString($value, $expected)
    {
        $price = new Price($value);

        $this->assertEquals($expected, (string)$price);
    }

    public function priceProvider()
    {
        return [
            [
                5, '5.00'
            ],
            [
                5.00, '5.00'
            ],
            [
                5.0, '5.00'
            ],
            [
                5.000, '5.00'
            ],
            [
                75.75, '75.75'
            ],
        ];
    }
}
