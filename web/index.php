<?php

// This procedural script outputs a list of customers that are within 100Km of Intercom's Dublin Office.

require __DIR__.'/../vendor/autoload.php';

use KieranBamforth\CustomerInviter\CustomerFilter\CustomerFilter;
use KieranBamforth\CustomerInviter\CustomerProvider\JsonProvider;
use KieranBamforth\CustomerInviter\DistanceCalculator\DistanceCalculator;

// Setup the instances variables that will get us the result.

$json = file_get_contents(__DIR__.'/resources/customers.json');
$jsonProvider = new JsonProvider($json);
$distanceCalculator = new DistanceCalculator();
$customerFilter = new CustomerFilter($jsonProvider, $distanceCalculator);

// Setup Intercom Dublin's Latitude/Longitude.
$latitude = 53.3381985;
$longitude = -6.2592576;
$maxDistanceKm = 100;

$customersWithinDistance = $customerFilter->getCustomersWithinDistance(
    $latitude,
    $longitude,
    $maxDistanceKm
);

echo '<h1>People to invite</h1>';

foreach ($customersWithinDistance as $customer) {
    echo(sprintf(
        '%s (user id: %s) is within %sKm of Intercom\'s Dublin office.<br/>',
        $customer->getName(),
        $customer->getUserId(),
        $maxDistanceKm
    ));
}

