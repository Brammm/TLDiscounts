<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Customer\CustomerRepository;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;

class HighRevenueCustomer implements Discount
{
    /**
     * @var CustomerRepository
     */
    private $repository;

    /**
     * @var Price
     */
    private $revenueLimit;

    public function __construct(CustomerRepository $repository, Price $revenueLimit)
    {
        $this->repository = $repository;
        $this->revenueLimit = $revenueLimit;
    }


    public function isApplicable(Order $order): bool
    {
        $customer = $this->repository->findById($order->getCustomerId());

        return $customer->getRevenue()->higherThan($this->revenueLimit);
    }

    public function apply(Order $order)
    {
        $order->getTotal()->applyDiscountPercentage(10);
    }

    public function getName(): string
    {
        return 'HighRevenueCustomer';
    }
}
