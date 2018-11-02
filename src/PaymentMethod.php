<?php

namespace Omnipay\SpryngPayments;

interface PaymentMethod
{
    /**
     * Get the required parameters to make a purchase with this payment method
     *
     * @return array
     */
    public static function requiredPurchaseParameters();

    /**
     * Get the URL to initiate a transaction with this payment method.
     *
     * @return string
     */
    public static function getInitiateUrl();

    /**
     * Takes the default data for a purchase request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setPurchaseData($data, $parameters);
}