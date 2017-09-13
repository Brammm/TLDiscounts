<?php

namespace Brammm\TLDiscounts\Application\Http;

use Brammm\TLDiscounts\Domain\Order\Item;
use Brammm\TLDiscounts\Domain\Order\Order;
use Brammm\TLDiscounts\Domain\Order\Price;
use Slim\Http\Request;
use Slim\Http\Response;

class DiscountsCalculateRequestHandler
{
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


        return $response;
    }
}
