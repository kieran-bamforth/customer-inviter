<?php

namespace KieranBamforth\CustomerInviter\DistanceCalculator;

class DistanceCalculator
{
    /**
     * This function was taken from this page:
     * http://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
     * as I do not think I have the time to fully understand the formula presented on the Harvesine wikipedia page.
     *
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     *
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     *
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    /**
     * Converts degrees to radians.
     *
     * @param integer $degrees
     *
     * @return float
     */
    public function degreesToRadians($degrees)
    {
        $radians = $degrees * pi() / 180;
        return round($radians, 6);
    }
}