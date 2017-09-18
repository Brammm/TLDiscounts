<?php

namespace Brammm\TLDiscounts\Domain\Customer;

interface CustomerRepository
{
    /**
     * Save a customer in the repository
     */
    public function save(Customer $customer): void;

    /**
     * Returns a customer from the repository
     *
     * @throws CustomerNotFoundException
     */
    public function findById(int $id): Customer;
}
