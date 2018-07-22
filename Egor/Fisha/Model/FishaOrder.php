<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\FishaOrderInterface;
use Magento\Framework\DataObject;

class FishaOrder extends DataObject implements FishaOrderInterface
{

    /**
     * Get the fisha shopper id
     *
     * @return int
     */
    public function getFishaShopperId()
    {
        return $this->getData(self::FISHA_SHOPPER_ID);
    }

    /**
     * Set the fisha shopper id
     *
     * @param int $id
     * @return $this
     */
    public function setFishaShopperId($id)
    {
        return $this->setData(self::FISHA_SHOPPER_ID, $id);
    }

    /**
     * Get the Order Id
     *
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set the Order Id
     *
     * @param string $orderId
     * @return string|null
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get the Order Total
     *
     * @return string|null
     */
    public function getOrderTotal()
    {
        return $this->getData(self::ORDER_TOTAL);
    }

    /**
     * Set the Order Total
     *
     * @param $orderTotal
     * @return $this
     */
    public function setOrderTotal($orderTotal)
    {
        return $this->setData(self::ORDER_TOTAL, $orderTotal);
    }

    /**
     * Get the token
     *
     * @return string|null
     */
    public function getToken()
    {
        return $this->getData(self::TOKEN);
    }

    /**
     * Set the token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        return $this->setData(self::TOKEN, $token);
    }
}
