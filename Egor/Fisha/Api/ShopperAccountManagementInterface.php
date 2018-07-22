<?php
namespace Egor\Fisha\Api;


use Egor\Fisha\Api\Data\ShopperInterface;

interface ShopperAccountManagementInterface
{
    /**
     * Create fisha shopper
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function createNewShopper(ShopperInterface $shopper);

    /**
     * Update fisha shopper data
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function updateShopper(ShopperInterface $shopper);
}