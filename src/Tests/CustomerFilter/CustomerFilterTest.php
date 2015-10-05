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
        $this->mockCustomerProvider = \Mockery::mock(
            'KieranBamforth\CustomerInviter\CustomerProvider\CustomerProviderInterface[haversineGreatCircleDistance]'
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