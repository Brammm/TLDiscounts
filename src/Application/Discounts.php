<?php

namespace Brammm\TLDiscounts\Application;

use Brammm\TLDiscounts\Application\Http\DiscountsCalculateRequestHandler;
use DI\Bridge\Slim\App;
use DI\ContainerBuilder;

class Discounts extends App
{
    /**
     * @var string
     */
    private $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
        parent::__construct();

        $this->loadHttp();
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions($this->rootDir . '/app/config.php');
    }

    private function loadHttp()
    {
        $this->post('/discounts.calculate', DiscountsCalculateRequestHandler::class);
    }
}
