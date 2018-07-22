<?php
namespace Egor\Fisha\Model;


use Egor\Fisha\Api\Data\ShopperInterface;
use Magento\Framework\DataObject;

class Shopper extends DataObject implements ShopperInterface
{
    /**
     * Get the id
     *
     * @return int
     */
    public function getFishaShopperId()
    {
        return $this->getData(self::FISHA_SHOPPER_ID);
    }

    /**
     * Set the id
     *
     * @param int $id
     * @return $this
     */
    public function setFishaShopperId($id)
    {
        return $this->setData(self::FISHA_SHOPPER_ID, $id);
    }

    /**
     * Get the Email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set the Email
     *
     * @param string $email
     * @return string|null
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get the last name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * Set the last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * Get the Name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set the Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get the phone
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * Set the Phone
     *
     * @param $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Get the city
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * Set the updated-at timestamp
     *
     * @param $city
     * @return $this
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * Get the city
     *
     * @return string|null
     */
    public function getStreet()
    {
        return $this->getData(self::STREET);
    }

    /**
     * Set the street
     *
     * @param $street
     * @return $this
     */
    public function setStreet($street)
    {
        return $this->setData(self::STREET, $street);
    }

    /**
     * Get the House Number
     *
     * @return string|null
     */
    public function getHouseNumber()
    {
        return $this->getData(self::HOUSE_NUMBER);
    }

    /**
     * Set the House Number
     *
     * @param $houseNumber
     * @return $this
     */
    public function setHouseNumber($houseNumber)
    {
        return $this->setData(self::HOUSE_NUMBER, $houseNumber);
    }
}
