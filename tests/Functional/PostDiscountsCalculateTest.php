<?php

namespace Brammm\TLDiscounts\Tests\Functional;

use Brammm\TLDiscounts\Tests\AppTestCase;

class PostDiscountsCalculateTest extends AppTestCase
{

    public function testOrderOne()
    {
        $response = $this->request('POST', '/discounts.calculate', [
            'id' => '1',
            'customer-id' => '1',
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 10,
                    'unit-price' => '4.99',
                    'total' => '49.90',
                ],
            ],
            'total' => '49.90',
        ]);

        $data = json_decode($response->getBody(), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => 1,
            'customer-id' => 1,
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 12,
                    'unit-price' => '4.99',
                    'total' => '49.90',
                    'applied-discount' => 'Buy5Get1Extra',
                ],
            ],
            'applied-discount' => null,
            'total' => '49.90',
        ], $data);
    }

    public function testOrderTwo()
    {
        $response = $this->request('POST', '/discounts.calculate', [
            'id' => '2',
            'customer-id' => '2',
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 5,
                    'unit-price' => '4.99',
                    'total' => '24.95',
                ],
            ],
            'total' => '24.95',
        ]);

        $data = json_decode($response->getBody(), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => '2',
            'customer-id' => '2',
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 6,
                    'unit-price' => '4.99',
                    'total' => '24.95',
                    'applied-discount' => 'Buy5Get1Extra',
                ],
            ],
            'applied-discount' => 'HighRevenueCustomer',
            'total' => '22.46',
        ], $data);
    }

    public function testOrderThree()
    {
        $response = $this->request('POST', '/discounts.calculate', [
            'id' => '3',
            'customer-id' => '3',
            'items' => [
                [
                    'product-id' => 'A101',
                    'quantity' => 2,
                    'unit-price' => '9.75',
                    'total' => '19.50',
                ],
                [
                    'product-id' => 'A102',
                    'quantity' => 1,
                    'unit-price' => '49.50',
                    'total' => '49.50',
                ],
            ],
            'total' => '69.00',
        ]);

        $data = json_decode($response->getBody(), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => '3',
            'customer-id' => '3',
            'items' => [
                [
                    'product-id' => 'A101',
                    'quantity' => 2,
                    'unit-price' => '9.75',
                    'total' => '15.60',
                    'applied-discount' => '20OffCheapest',
                ],
                [
                    'product-id' => 'A102',
                    'quantity' => 1,
                    'unit-price' => '49.50',
                    'total' => '49.50',
                    'applied-discount' => null,
                ],
            ],
            'applied-discount' => null,
            'total' => '65.10',
        ], $data);
    }

    public function testOrderFour()
    {
        $response = $this->request('POST', '/discounts.calculate', [
            'id' => '4',
            'customer-id' => '2',
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 5,
                    'unit-price' => '4.99',
                    'total' => '24.95',
                ],
                [
                    'product-id' => 'A101',
                    'quantity' => 2,
                    'unit-price' => '9.75',
                    'total' => '19.50',
                ],
                [
                    'product-id' => 'A102',
                    'quantity' => 1,
                    'unit-price' => '49.50',
                    'total' => '49.50',
                ],
            ],
            'total' => '69.00',
        ]);

        $data = json_decode($response->getBody(), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => '4',
            'customer-id' => '2',
            'items' => [
                [
                    'product-id' => 'B102',
                    'quantity' => 6,
                    'unit-price' => '4.99',
                    'total' => '24.95',
                    'applied-discount' => 'Buy5Get1Extra',
                ],
                [
                    'product-id' => 'A101',
                    'quantity' => 2,
                    'unit-price' => '9.75',
                    'total' => '15.60',
                    'applied-discount' => '20OffCheapest',
                ],
                [
                    'product-id' => 'A102',
                    'quantity' => 1,
                    'unit-price' => '49.50',
                    'total' => '49.50',
                    'applied-discount' => null,
                ],
            ],
            'applied-discount' => 'HighRevenueCustomer',
            'total' => '81.05',
        ], $data);
    }
}
