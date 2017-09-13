<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Customer;

use Brammm\TLDiscounts\Domain\Customer\SinceDate;
use PHPUnit\Framework\TestCase;

class SinceDateTest extends TestCase
{
    public function testItFormatsToString()
    {
        $since = SinceDate::fromISOString('2017-01-01');

        $this->assertEquals('2017-01-01', (string)$since);
    }
}
