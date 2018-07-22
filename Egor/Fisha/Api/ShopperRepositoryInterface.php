<?php

namespace Egor\Fisha\Api;

use Egor\Fisha\Api\Data\ShopperInterface;

interface ShopperRepositoryInterface
{
    /**
     * Get shopper by id
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function getShopperById(ShopperInterface $shopper);
}
