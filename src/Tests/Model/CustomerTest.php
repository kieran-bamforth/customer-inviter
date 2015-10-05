<?php

use KieranBamforth\CustomerInviter\Model\Customer;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSet()
    {
        $userId = 1;
        $name = 'Kieran Bamforth';
        $lng = -6.043701;
        $lat = 52.986375;

        $customer = new Customer();
        $customer->setUserId($userId)
            ->setName($name)
            ->setLongitude($lng)
            ->setLatitude($lat);

        $this->assertEquals(
            $userId,
            $customer->getUserId()
        );

        $this->assertEquals(
            $name,
            $customer->getName()
        );

        $this->assertEquals(
            $lng,
            $customer->getLongitude()
        );

        $this->assertEquals(
            $lat,
            $customer->getLatitude()
        );
    }

    public function testSetUserIdInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $customer = new Customer();
        $customer->setUserId('invalid');
    }

    public function testSetNameInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $customer = new Customer();
        $customer->setName(1);;
    }

    public function testSetLatitudeInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $customer = new Customer();
        $customer->setLatitude('invalid');
    }

    public function testSetLongitudeInvalid()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $customer = new Customer();
        $customer->setLongitude('invalid');
    }
}