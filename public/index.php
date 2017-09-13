<?php

namespace {

    use Brammm\TLDiscounts\Application\Discounts;

    require(__DIR__ . '/../vendor/autoload.php');

    $app = new Discounts(__DIR__ . '/../');

    $app->run();
}

