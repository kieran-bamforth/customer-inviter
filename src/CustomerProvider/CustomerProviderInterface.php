<?php

namespace KieranBamforth\CustomerInviter\CustomerProvider;

/**
 * Interface CustomerProviderInterface
 *
 * Exposes an interface that classes can implement if they are able
 * to provide an array of customers.
 *
 * @package KieranBamforth\CustomerInviter\CustomerProvider
 */
interface CustomerProviderInterface
{
    /**
     * Returns a list of customers.
     *
     * @return array<Customer>
     */
    public function getCustomers();
}