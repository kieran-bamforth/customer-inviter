<?php

namespace KieranBamforth\CustomerInviter\CustomerFilter;

use KieranBamforth\CustomerInviter\CustomerProvider\CustomerProviderInterface;
use KieranBamforth\CustomerInviter\DistanceCalculator\DistanceCalculator;
use KieranBamforth\CustomerInviter\Model\Customer;

/**
 * Class CustomerFilter
 *
 * Use this class to decorate CustomerProvider classes with filtering functionality.
 *
 * @package KieranBamforth\CustomerInviter\CustomerFilter
 */
class CustomerFilter
{
    private $customerProvider;
    private $distanceCalculator;

    public function __construct(
        CustomerProviderInterface $customerProvider,
        DistanceCalculator $distanceCalculator
    ) {
        $this->customerProvider = $customerProvider;
        $this->distanceCalculator = $distanceCalculator;
    }

    /**
     * Gets the customers that are within a distance to a given latitude / longitude.
     *
     * @param float $latitudeTo      The latitude to check the customers are in distance of.
     * @param float $longitudeTo     The longitude to check the customers are in distance of.
     * @param float $maxDistanceInKm The maximum distance before the customers are considered
     *                               "within distance".
     *
     * @return array<Customer>
     */
    public function getCustomersWithinDistance($latitudeTo, $longitudeTo, $maxDistanceInKm)
    {
        $customers = $this->customerProvider->getCustomers();

        $filtered = [];

        foreach ($customers as $customer) {
            $inDistance = $this->isCustomerWithinDistance(
                $customer,
                $latitudeTo,
                $longitudeTo,
                $maxDistanceInKm
            );

            if ($inDistance) {
                $filtered[] = $customer;
            }
        }

        return $filtered;
    }

    /**
     * Checks if a customer is within the distance of a given latitude / longitude in kilometers.
     *
     * @param Customer $customer        The customer to check.
     * @param float    $latitudeTo      The latitude to check the customer is in distance of.
     * @param float    $longitudeTo     The longitude to check the customer is in distance of.
     * @param float    $maxDistanceInKm The maximum distance before the customer is considered not
     *                                  "within distance".
     *
     * @return bool
     */
    public function isCustomerWithinDistance(
        Customer $customer,
        $latitudeTo,
        $longitudeTo,
        $maxDistanceInKm
    ) {
        $distanceInKm = $this->distanceCalculator->haversineGreatCircleDistance(
            $customer->getLatitude(),
            $customer->getLongitude(),
            $latitudeTo,
            $longitudeTo,
            6371
        );

        return $distanceInKm <= $maxDistanceInKm;
    }

    /**
     * Sorts an array of customers by their user ID ascending.
     *
     * @param array<Customer> $customers An array of customers to sort
     *
     * @return array<Customer>
     */
    public function sortCustomersByUserId(array $customers)
    {
        usort($customers, function(Customer $customera, Customer $customerb) {
            return $customera->getUserId() - $customerb->getUserId();
        });

        return $customers;
    }
}