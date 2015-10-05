<?php

namespace KieranBamforth\CustomerInviter\Tests\CustomerProvider;

use KieranBamforth\CustomerInviter\CustomerProvider\JsonProvider;

class JsonProviderTest extends \PHPUnit_Framework_TestCase
{
    private $json;
    private $jsonProvider;

    public function setup()
    {
        $this->json = file_get_contents(sprintf(
            '%s/../../../web/resources/customers.json',
            __DIR__
        ));

        $this->jsonProvider = new JsonProvider($this->json);
    }

    public function testGetCustomersInvalidJson()
    {
        $this->setExpectedException('\UnexpectedValueException');

        $jsonProvider = new JsonProvider('invalid json');

        $jsonProvider->getCustomers();
    }

    public function testGetCustomersInvalidCustomer()
    {
        $this->setExpectedException('\DomainException');

        $jsonProvider = \Mockery::mock(
            '\KieranBamforth\CustomerInviter\CustomerProvider\JsonProvider[isCustomerValid]',
            [$this->json]
        );

        $jsonProvider->shouldReceive('isCustomerValid')->andReturn(false);

        $jsonProvider->getCustomers();
    }

    /**
     * @dataProvider isCustomerValidDataProvider
     *
     * @param array $input          The input to test
     * @param bool  $expectedOutput The expected result
     *
     * @return void
     */
    public function testIsCustomerValid(array $input, $expectedOutput)
    {
        $this->assertEquals(
            $expectedOutput,
            $this->jsonProvider->isCustomerValid($input)
        );
    }

    public function isCustomerValidDataProvider()
    {
        $validCustomer = [
            'user_id' => 1,
            'name' => 'somename',
            'longitude' => '-8.371639',
            'latitude' => '54.374208'
        ];

        $invalidCustomer = [
            'user_id' => 1,
            'name' => 'somename',
            'longitude' => '-8.371639',
        ];

        return [
            [$validCustomer, true],
            [$invalidCustomer, false],
            [[], false]
        ];
    }
}