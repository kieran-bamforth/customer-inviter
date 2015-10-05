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