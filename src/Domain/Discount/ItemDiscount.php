<?php

namespace Brammm\TLDiscounts\Domain\Discount;

use Brammm\TLDiscounts\Domain\Order\Item;

interface ItemDiscount extends Discount
{
    public function applyItem(Item $item);
}
