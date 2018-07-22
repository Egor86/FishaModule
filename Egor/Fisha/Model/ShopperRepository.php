<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\ShopperInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class ShopperRepository implements \Egor\Fisha\Api\ShopperRepositoryInterface
{
    /**
     * @var \Egor\Fisha\Api\FishaProviderInterface
     */
    private $fishaProvider;

    /**
     * ShopperRepository constructor.
     * @param \Egor\Fisha\Api\FishaProviderInterface $fishaProvider
     */
    public function __construct(\Egor\Fisha\Api\FishaProviderInterface $fishaProvider)
    {
        $this->fishaProvider = $fishaProvider;
    }

    /**
     * Get shopper by id
     *
     * @param ShopperInterface $shopper
     * @return ShopperInterface
     * @throws NoSuchEntityException
     */
    public function getShopperById(ShopperInterface $shopper)
    {
        $fishaShopperData = $this->fishaProvider->call('getShopperById', ['fishaShopperId' => $shopper->getFishaShopperId()]);

        foreach ($fishaShopperData as $kay => $value) {
            $shopper->setData($kay, $value);
        }

        return $shopper;
    }
}
