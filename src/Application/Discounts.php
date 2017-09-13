<?php

namespace Brammm\TLDiscounts\Application;

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
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions($this->rootDir . '/app/config.php');
    }
}
