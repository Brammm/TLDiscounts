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

    public function higherThan(Price $price): bool
    {
        return $this->money->greaterThan($price->money);
    }

    public function lowerThan(Price $price): bool
    {
        return $this->money->lessThan($price->money);
    }

    public function applyDiscountPercentage(int $percentage): void
    {
        $this->money = $this->money->multiply((100 - $percentage) / 100);
    }

    public function add(Price $price): void
    {
        $this->money = $this->money->add($price->money);
    }
}
