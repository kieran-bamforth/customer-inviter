<?php

namespace KieranBamforth\CustomerInviter\Tests\CustomerFilter;

use KieranBamforth\CustomerInviter\CustomerFilter\CustomerFilter;
use KieranBamforth\CustomerInviter\Model\Customer;

class CustomerFilterTest extends \PHPUnit_Framework_TestCase
{
    private $mockCustomerProvider;
    private $mockDistanceCalculator;
    private $customerFilter;

    public function setup()
    {
        $customersResult = [new Customer()];

        $this->mockCustomerProvider = \Mockery::mock(
            'KieranBamforth\CustomerInviter\CustomerProvider\CustomerProviderInterface[haversineGreatCircleDistance]',
            ['getCustomers' => $customersResult]
        );

        $this->mockCustomerProvider->shouldReceive('haversineGreatCircleDistance')
            ->andReturn(100)
            ->byDefault();

        $this->mockDistanceCalculator = \Mockery::mock(
            'KieranBamforth\CustomerInviter\DistanceCalculator\DistanceCalculator'
        );

        $this->customerFilter = new CustomerFilter(
            $this->mockCustomerProvider,
            $this->mockDistanceCalculator
        );
    }

    /**
     * @dataProvider getCustomersWithinDistanceDataProvider
     *
     * @param bool    $inDistance    Determines if the customer is in the distance.
     * @param integer $expectedCount The expected count of the customers "in distance".
     *
     * @return void
     */
    public function testGetCustomersWithinDistance($inDistance, $expectedCount)
    {
        $customerFilter = \Mockery::mock(
            'KieranBamforth\CustomerInviter\CustomerFilter\CustomerFilter[isCustomerWithinDistance]',
            [$this->mockCustomerProvider, $this->mockDistanceCalculator]
        );

        $customerFilter->shouldReceive('isCustomerWithinDistance')->andReturn($inDistance);

        $customersInDistance = $customerFilter->getCustomersWithinDistance(
            0,
            0,
            100
        );

        $this->assertCount($expectedCount, $customersInDistance);
    }

    public function getCustomersWithinDistanceDataProvider()
    {
        return [
            [true, 1],
            [false, 0]
        ];
    }

    /**
     * @dataProvider isCustomerWithinDistanceDataProvider
     *
     * @param float $haversineResult What will be returned by the haversine function.
     * @param bool  $expectedOutput  The expected result.
     *
     * @return void
     */
    public function testIsCustomerWithinDistance($haversineResult, $expectedOutput)
    {
        $this->mockDistanceCalculator->shouldReceive('haversineGreatCircleDistance')
            ->andReturn($haversineResult);

        $isCustomerWithinDistance = $this->customerFilter->isCustomerWithinDistance(
            new Customer(),
            0,
            0,
            100
        );

        $this->assertEquals(
            $expectedOutput,
            $isCustomerWithinDistance
        );
    }

    public function isCustomerWithinDistanceDataProvider()
    {
        return [
            [99, true],
            [100, true],
            [101, false]
        ];
    }
}