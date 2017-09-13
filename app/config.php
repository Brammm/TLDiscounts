<?php

namespace {

    use Brammm\TLDiscounts\Application\Customer\InMemoryCustomerRepository;
    use Brammm\TLDiscounts\Application\Product\InMemoryProductRepository;
    use Brammm\TLDiscounts\Domain\Customer\Customer;
    use Brammm\TLDiscounts\Domain\Customer\CustomerRepository;
    use Brammm\TLDiscounts\Domain\Customer\SinceDate;
    use Brammm\TLDiscounts\Domain\Price\Price;
    use Brammm\TLDiscounts\Domain\Product\Category;
    use Brammm\TLDiscounts\Domain\Product\Product;
    use Brammm\TLDiscounts\Domain\Product\ProductRepository;

    return [
        CustomerRepository::class => function() {
            $repo = new InMemoryCustomerRepository();

            $json = file_get_contents(__DIR__ . '/data/customers.json');
            foreach (json_decode($json, true) as $customer) {
                $repo->save(new Customer(
                    $customer['id'],
                    $customer['name'],
                    SinceDate::fromISOString($customer['since']),
                    new Price($customer['revenue'])
                ));
            }

            return $repo;
        },

        ProductRepository::class => function() {
            $repo = new InMemoryProductRepository();

            $json = file_get_contents(__DIR__ . '/data/products.json');
            foreach (json_decode($json, true) as $product) {
                $repo->save(new Product(
                    $product['id'],
                    $product['description'],
                    new Category((int)$product['category']),
                    new Price($product['price'])
                ));
            }

            return $repo;
        },
    ];
}
