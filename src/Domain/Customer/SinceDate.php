<?php

namespace Brammm\TLDiscounts\Domain\Customer;

use Cake\Chronos\Chronos;

class SinceDate
{
    /**
     * @var Chronos
     */
    private $date;

    private function __construct(Chronos $date)
    {
        $this->date = $date;
    }

    public static function fromISOString(string $string)
    {
        [$year, $month, $date] = explode('-', $string);

        return new static(
            Chronos::createFromDate($year, $month, $date)
        );
    }

    public function __toString()
    {
        return $this->date->format('Y-m-d');
    }
}
