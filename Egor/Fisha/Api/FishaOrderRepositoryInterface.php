<?php
namespace Egor\Fisha\Api;


use Egor\Fisha\Api\Data\ShopperInterface;

interface FishaOrderRepositoryInterface
{
    /**
     * Get orders for shopper
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function getOrders(ShopperInterface $shopper);
}