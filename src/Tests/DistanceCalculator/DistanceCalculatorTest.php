<?php

namespace KieranBamforth\CustomerInviter\Tests\DistanceCalculator;

use KieranBamforth\CustomerInviter\DistanceCalculator\DistanceCalculator;

class DistanceCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $distanceCalculator;

    public function setup()
    {
        $this->distanceCalculator = new DistanceCalculator();
    }


    /**
     * Tests that a given location is close to Intercom Dublin office.
     *
     * @dataProvider harversineGreatCircleDistanceDataProvider
     *
     * @param $longTo
     * @param $latTo
     * @param $expected
     *
     * @return void
     */
    public function testHaversineGreatCircleDistance($latTo, $longTo, $expected)
    {
        $intercomOfficeLat = 53.3381985;
        $intercomOfficeLng =  -6.2592576;

        $result = $this->distanceCalculator->haversineGreatCircleDistance(
            $intercomOfficeLat,
            $intercomOfficeLng,
            $latTo,
            $longTo,
            6371
        );

        $this->assertEquals($expected, round($result,2));
    }

    /**
     * These expectations come from http://www.movable-type.co.uk/scripts/latlong.html.
     */
    public function harversineGreatCircleDistanceDataProvider()
    {
        return [
            [52.986375, -6.043701, 41.68],
            [51.92893, -10.27699, 313.10]
        ];
    }

    /**
     * @dataProvider degreesToRadiansDataProvider
     *
     * @param integer $degrees        The input degrees
     * @param float   $expectedOutput The expected output radians.
     *
     * @return void
     */
    public function testDegreesToRadians($degrees, $expectedOutput)
    {
        $this->assertEquals(
            $expectedOutput,
            $this->distanceCalculator->degreesToRadians($degrees)
        );
    }

    public function degreesToRadiansDataProvider()
    {
        return [
            [57, 0.994838],
            [85, 1.48353],
            [120, 2.094395]
        ];
    }
}