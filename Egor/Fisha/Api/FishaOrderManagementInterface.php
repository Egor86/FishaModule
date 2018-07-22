<?php
namespace Egor\Fisha\Api;


use Egor\Fisha\Api\Data\FishaOrderInterface;

interface FishaOrderManagementInterface
{
    /**
     * Create fisha order
     *
     * @param FishaOrderInterface $fishaOrder
     * @return mixed
     */
    public function createNewOrder(FishaOrderInterface $fishaOrder);
}
