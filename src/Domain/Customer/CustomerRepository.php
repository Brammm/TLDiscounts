<?php

namespace Brammm\TLDiscounts\Domain\Customer;

interface CustomerRepository
{
    public function save(Customer $customer);

    public function findById(int $id): Customer;
}
