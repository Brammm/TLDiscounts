<?php

namespace Brammm\TLDiscounts\Tests\Unit\Domain\Discount;

use Brammm\TLDiscounts\Domain\Customer\Customer;
use Brammm\TLDiscounts\Domain\Customer\CustomerRepository;
use Brammm\TLDiscounts\Domain\Customer\SinceDate;
use Brammm\TLDiscounts\Domain\Discount\HighRevenueCustomer;
use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class HighRevenueCustomerTest extends TestCase
{
    /**
     * @var CustomerRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private $repo;

    /**
     * @var HighRevenueCustomer
     */
    private $discount;

    /**
     * @var Order
     */
    private $order;

    public function setUp()
    {
        $this->repo = $this->createMock(CustomerRepository::class);

        $this->discount = new HighRevenueCustomer($this->repo, new Price(100));

        $this->order = new Order(
            1,
            1,
            [
                new Item(
                    'foo',
                    1,
                    new Price(10),
                    new Price(10)
                ),
            ],
            new Price(10)
        );
    }

    public function testItIsApplicable()
    {
        $this->repo->method('findById')
            ->willReturn(new Customer(
                1,
                'Foo',
                SinceDate::fromISOString('2017-01-01'),
                new Price(120)
            ));

        $this->assertTrue($this->discount->isApplicable($this->order));
    }

    public function testItIsntApplicable()
    {
        $this->repo->method('findById')
            ->willReturn(new Customer(
                1,
                'Foo',
                SinceDate::fromISOString('2017-01-01'),
                new Price(80)
            ));

        $this->assertFalse($this->discount->isApplicable($this->order));
    }

    public function testItAppliesDiscount()
    {
        $this->discount->apply($this->order);

        $this->assertEquals(new Price(9), $this->order->getTotal());
    }
}
