<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\FishaOrderInterface;
use Egor\Fisha\Api\Data\ShopperInterface;
use Magento\Customer\Model\Customer;
use Magento\Sales\Api\Data\OrderInterface;

class Mapper
{
    /**
     * @param ShopperInterface $shopper
     * @param Customer $customer
     */
    public function customerToShopper(ShopperInterface &$shopper, Customer $customer)
    {
        $address = $customer->getDefaultBillingAddress();
        $shopperData = [
            ShopperInterface::FISHA_SHOPPER_ID => $customer->getFishaShopperId(),
            ShopperInterface::EMAIL => $customer->getEmail(),
            ShopperInterface::LAST_NAME => $customer->getLastname(),
            ShopperInterface::NAME => $customer->getFirstname(),
            ShopperInterface::PHONE => $address->getTelephone(),
            ShopperInterface::CITY => $address->getCity(),
            ShopperInterface::STREET => $address->getStreetFull(),
            ShopperInterface::HOUSE_NUMBER => $address->getPostcode()
        ];

        $shopper->setData($shopperData);
    }

    public function orderToFishaOrder(FishaOrderInterface &$fishaOrder, OrderInterface $order)
    {
        $orderData = [
            FishaOrderInterface::ORDER_ID => $order->getEntityId(),
            FishaOrderInterface::ORDER_TOTAL => $order->getGrandTotal(),
            FishaOrderInterface::TOKEN => md5($order->getEntityId().$fishaOrder->getFishaShopperId()),
        ];

        $fishaOrder->setData($orderData);
    }
}
