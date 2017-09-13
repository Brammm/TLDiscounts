<?php

namespace Brammm\TLDiscounts\Domain\Order;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class Price
{
    /**
     * @var Money
     */
    private $money;

    public function __construct(float $price)
    {
        $this->money = new Money($price * 100, new Currency('EUR'));
    }

    public function __toString()
    {
        $formatter = new DecimalMoneyFormatter(new ISOCurrencies());

        return $formatter->format($this->money);
    }
}
