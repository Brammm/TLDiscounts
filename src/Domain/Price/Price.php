<?php

namespace Brammm\TLDiscounts\Domain\Price;

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

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function higherThan(Price $revenueLimit): bool
    {
        return $this->money->greaterThan($revenueLimit->getMoney());
    }

    public function applyDiscountPercentage(int $percentage)
    {
        $this->money = $this->money->multiply((100 - $percentage) / 100);
    }
}
