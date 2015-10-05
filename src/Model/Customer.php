<?php

namespace KieranBamforth\CustomerInviter\Model;

/**
 * Class Customer
 *
 * The domain model that Represents a customer in the Customer Inviter system.
 *
 * @package KieranBamforth\CustomerInviter\Model
 */
class Customer {

    private $userId;
    private $name;
    private $longitude;
    private $latitude;

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     *
     * @throws \InvalidArgumentException
     *
     * return Customer
     */
    public function setUserId($userId)
    {
        if (!is_numeric($userId)) {
            throw new \InvalidArgumentException('Expected $userId to be of type numeric.');
        }

        $this->userId = (int)$userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * return Customer
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Expected $name to be of type string.');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @throws \InvalidArgumentException
     *
     * @return Customer
     */
    public function setLongitude($longitude)
    {
        if (!is_numeric($longitude)) {
            throw new \InvalidArgumentException('Expected $longitude to be of type numeric.');
        }

        $this->longitude = (float)$longitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @throws \InvalidArgumentException
     *
     * return Customer
     */
    public function setLatitude($latitude)
    {
        if (!is_numeric($latitude)) {
            throw new \InvalidArgumentException('Expected $latitude to be of type numeric.');
        }

        $this->latitude = (float)$latitude;

        return $this;
    }

}