<?php

namespace {

    use Brammm\TLDiscounts\Application\Discounts;

    require(__DIR__ . '/../vendor/autoload.php');

    (new Discounts(__DIR__ . '/../'))->run();
}

