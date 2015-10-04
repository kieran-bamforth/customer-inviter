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
}