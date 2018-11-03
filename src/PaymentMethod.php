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
     * Get the URL to refund a transaction
     *
     * @param $transactionReference
     * @return mixed
     */
    public static function getRefundUrl($transactionReference);

    /**
     * Get the required parameters to complete a refund with this method
     *
     * @return array
     */
    public static function requiredRefundParameters();

    /**
     * Takes the default data for a purchase request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setPurchaseData($data, $parameters);

    /**
     * Takes the default data for a refund request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setRefundData($data, $parameters);
}