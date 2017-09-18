<?php

namespace Brammm\TLDiscounts\Application\Customer;

use Brammm\TLDiscounts\Domain\Customer\Customer;
use Brammm\TLDiscounts\Domain\Customer\CustomerNotFoundException;
use Brammm\TLDiscounts\Domain\Customer\CustomerRepository;

class InMemoryCustomerRepository implements CustomerRepository
{
    /**
     * @var Customer[]
     */
    private $customers;

    public function save(Customer $customer): void
    {
        $this->customers[$customer->getId()] = $customer;
    }

    public function findById(int $id): Customer
    {
        if (isset($this->customers[$id])) {
            return $this->customers[$id];
        }

        throw CustomerNotFoundException::forId($id);
    }
}
