<?php

namespace Brammm\TLDiscounts\Tests\Integration;

use Brammm\TLDiscounts\Domain\Customer\CustomerNotFoundException;
use Brammm\TLDiscounts\Domain\Customer\CustomerRepository;
use Brammm\TLDiscounts\Domain\Customer\SinceDate;
use Brammm\TLDiscounts\Domain\Price\Price;
use Brammm\TLDiscounts\Tests\AppTestCase;

class CustomerRepositoryTest extends AppTestCase
{
    public function testItFindsCustomer()
    {
        $customer = $this->getContainer()->get(CustomerRepository::class)->findById(1);

        $this->assertSame(1, $customer->getId());
        $this->assertSame('Coca Cola', $customer->getName());
        $this->assertEquals(SinceDate::fromISOString('2014-06-28'), $customer->getSince());
        $this->assertEquals(new Price(492.12), $customer->getRevenue());
    }

    public function testItThrowsExceptionOnNotFound()
    {
        $this->expectException(CustomerNotFoundException::class);

        $this->getContainer()->get(CustomerRepository::class)->findById(4);
    }
}
