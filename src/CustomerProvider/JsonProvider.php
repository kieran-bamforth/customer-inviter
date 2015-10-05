<?php

namespace KieranBamforth\CustomerInviter\CustomerProvider;

use KieranBamforth\CustomerInviter\Model\Customer;

/**
 * Class JsonProvider
 *
 * Provides customers from a JSON string.
 *
 * @package KieranBamforth\CustomerInviter\CustomerProvider
 */
class JsonProvider implements CustomerProviderInterface
{
    private $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    /**
     * @{inheritDoc}
     */
    public function getCustomers()
    {
        if (null === $customers = json_decode($this->json, true)) {
            throw new \UnexpectedValueException('Failed to decode the provided JSON.');
        };

        $domainCustomers = [];

        foreach ($customers as $customer) {
            if (!$this->isCustomerValid($customer)) {
                throw new \DomainException('There was an invalid customer entry in your JSON.');
            }

            $domainCustomer = new Customer();

            $domainCustomer->setUserId($customer['user_id'])
                ->setName($customer['name'])
                ->setLongitude($customer['longitude'])
                ->setLatitude($customer['latitude']);

            $domainCustomers[] = $domainCustomer;
        }

        return $domainCustomers;
    }

    /**
     * Checks if an associative array contains the keys necessary to create a Customer domain object.
     *
     * @param array $customer
     *
     * @return bool
     */
    public function isCustomerValid(array $customer)
    {
        $expectedKeys = [
            'user_id',
            'name',
            'longitude',
            'latitude'
        ];

        $missingKeys = array_diff(
            $expectedKeys,
            array_keys($customer)
        );

        if (empty($missingKeys)) {
            return true;
        }

        return false;
    }
}