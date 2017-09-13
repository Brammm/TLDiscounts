<?php

namespace Brammm\TLDiscounts\Tests;

use Brammm\TLDiscounts\Application\Discounts;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

class AppTestCase extends TestCase
{
    /**
     * @var Discounts
     */
    private $app;

    public function setUp()
    {
        $this->app = new Discounts(__DIR__ . '/..');
    }

    protected function request(string $requestMethod, string $requestUri, array $requestData = []): ResponseInterface
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        return $this->app->process($request, new Response());
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->app->getContainer();
    }
}
