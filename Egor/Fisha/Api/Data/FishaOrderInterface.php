<?php
namespace Egor\Fisha\Api\Data;


interface FishaOrderInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FISHA_SHOPPER_ID = 'fisha_shopper_id';
    const ORDER_ID = 'order_id';
    const ORDER_TOTAL = 'order_total';
    const TOKEN = 'token';
    /**#@-*/

    /**
     * Get the fisha shopper id
     *
     * @return int
     */
    public function getFishaShopperId();

    /**
     * Set the fisha shopper id
     *
     * @param int $id
     * @return $this
     */
    public function setFishaShopperId($id);

    /**
     * Get the Order Id
     *
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set the Order Id
     *
     * @param string $orderId
     * @return string|null
     */
    public function setOrderId($orderId);

    /**
     * Get the Order Total
     *
     * @return string|null
     */
    public function getOrderTotal();

    /**
     * Set the Order Total
     *
     * @param $orderTotal
     * @return $this
     */
    public function setOrderTotal($orderTotal);

    /**
     * Get the token
     *
     * @return string|null
     */
    public function getToken();

    /**
     * Set the token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token);
}