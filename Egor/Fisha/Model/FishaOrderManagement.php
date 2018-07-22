<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\FishaOrderInterface;
use Egor\Fisha\Api\FishaOrderManagementInterface;

class FishaOrderManagement implements FishaOrderManagementInterface
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
     * Create fisha order
     *
     * @param FishaOrderInterface $fishaOrder
     * @return mixed
     */
    public function createNewOrder(FishaOrderInterface $fishaOrder)
    {
        return $this->fishaProvider->call('createNewOrder', $fishaOrder->toArray());
    }
}