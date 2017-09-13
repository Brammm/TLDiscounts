<?php

namespace Brammm\TLDiscounts\Domain\Customer;

use Brammm\TLDiscounts\Domain\Price\Price;

class Customer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var SinceDate
     */
    private $since;

    /**
     * @var Price
     */
    private $revenue;

    public function __construct(int $id, string $name, SinceDate $since, Price $revenue)
    {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSince(): SinceDate
    {
        return $this->since;
    }

    public function getRevenue(): Price
    {
        return $this->revenue;
    }
}
