<?php

namespace Brammm\TLDiscounts\Application\Http;

use Slim\Http\Request;
use Slim\Http\Response;

class DiscountsCalculateRequestHandler
{
    public function __invoke(Request $request, Response $response)
    {
        return $response;
    }
}
