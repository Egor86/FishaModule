<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\ShopperInterface;
use Egor\Fisha\Api\FishaOrderRepositoryInterface;

class FishaOrderRepository implements FishaOrderRepositoryInterface
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
     * Get orders for shopper
     *
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function getOrders(ShopperInterface $shopper)
    {
        return $this->fishaProvider->call('getOrders', ['fishaShopperId' => $shopper->getFishaShopperId()]);
    }
}