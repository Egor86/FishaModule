<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\ShopperInterface;
use Egor\Fisha\Api\ShopperAccountManagementInterface;

class ShopperAccountManagement implements ShopperAccountManagementInterface
{

    /**
     * @var \Egor\Fisha\Api\FishaProviderInterface
     */
    private $fishaProvider;

    /**
     * ShopperAccountManagement constructor.
     * @param \Egor\Fisha\Api\FishaProviderInterface $fishaProvider
     */
    public function __construct(\Egor\Fisha\Api\FishaProviderInterface $fishaProvider)
    {
        $this->fishaProvider = $fishaProvider;
    }
    /**
     * Create fisha shopper
     *
     * @param ShopperInterface $shopper
     * @return int
     */
    public function createNewShopper(ShopperInterface $shopper)
    {
        return $this->fishaProvider->call('createNewShopper', $shopper->toArray());
    }

    /**
     * Update fisha shopper data
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function updateShopper(ShopperInterface $shopper)
    {
        return $this->fishaProvider->call('updateShopper', $shopper->toArray());
    }
}