<?php

namespace Omnipay\SpryngPayments\Support;

trait DoesNotSupportRefunds
{
    /**
     * Get the URL to refund a transaction
     *
     * @param $transactionReference
     * @return mixed
     */
    public static function getRefundUrl($transactionReference)
    {
        return null;
    }

    /**
     * Get the required parameters to complete a refund with this method
     *
     * @return array
     */
    public static function requiredRefundParameters()
    {
        return null;
    }

    /**
     * Takes the default data for a refund request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setRefundData($data, $parameters)
    {
        return $data;
    }
}