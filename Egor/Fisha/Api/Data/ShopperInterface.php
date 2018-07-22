<?php

namespace Egor\Fisha\Api\Data;

interface ShopperInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FISHA_SHOPPER_ID = 'fisha_shopper_id';
    const EMAIL = 'email';
    const LAST_NAME = 'lastname';
    const NAME = 'name';
    const PHONE = 'phone';
    const CITY = 'city';
    const STREET = 'street';
    const HOUSE_NUMBER = 'house_number';
    /**#@-*/

    /**
     * Get the id
     *
     * @return int
     */
    public function getFishaShopperId();

    /**
     * Set the id
     *
     * @param int $id
     * @return $this
     */
    public function setFishaShopperId($id);

    /**
     * Get the Email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set the Email
     *
     * @param string $email
     * @return string|null
     */
    public function setEmail($email);

    /**
     * Get the last name
     *
     * @return string|null
     */
    public function getLastName();

    /**
     * Set the last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName);

    /**
     * Get the Name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set the Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get the phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set the Phone
     *
     * @param $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Get the city
     *
     * @return string|null
     */
    public function getCity();

    /**
     * Set the updated-at timestamp
     *
     * @param $city
     * @return $this
     */
    public function setCity($city);

    /**
     * Get the city
     *
     * @return string|null
     */
    public function getStreet();

    /**
     * Set the street
     *
     * @param $street
     * @return $this
     */
    public function setStreet($street);

    /**
     * Get the House Number
     *
     * @return string|null
     */
    public function getHouseNumber();

    /**
     * Set the House Number
     *
     * @param $houseNumber
     * @return $this
     */
    public function setHouseNumber($houseNumber);
}
