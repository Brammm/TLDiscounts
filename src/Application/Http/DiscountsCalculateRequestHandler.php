<?php

namespace Brammm\TLDiscounts\Application\Http;

use Brammm\TLDiscounts\Domain\Discount\DiscountCalculator;
use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Price\Price;
use Slim\Http\Request;
use Slim\Http\Response;

class DiscountsCalculateRequestHandler
{
    /**
     * @var DiscountCalculator
     */
    private $calculator;

    public function __construct(DiscountCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function __invoke(Request $request, Response $response)
    {
        // TODO: Add validation that these parameters are set
        $items = [];
        foreach ($request->getParsedBody()['items'] as $item) {
            $items[] = new Item(
                $item['product-id'],
                (int)$item['quantity'],
                new Price((float)$item['unit-price']),
                new Price((float)$item['total'])
            );
        }

        $order = new Order(
            (int)$request->getParsedBody()['id'],
            (int)$request->getParsedBody()['customer-id'],
            $items,
            new Price((float)$request->getParsedBody()['total'])
        );

        $this->calculator->process($order);

        return $response->withJson($order);
    }
}
