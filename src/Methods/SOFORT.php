<?php

namespace Omnipay\SpryngPayments\Methods;

use Omnipay\SpryngPayments\PaymentMethod;

class SOFORT implements PaymentMethod
{

    /**
     * Get the required parameters to make a purchase with this payment method
     *
     * @return array
     */
    public static function requiredPurchaseParameters()
    {
        return [
            'account',
            'amount',
            'capture',
            'customerIp',
            'dynamicDescriptor',
            'merchantReference',
            'projectId',
            'returnUrl',
            'userAgent'
        ];
    }

    /**
     * Get the URL to initiate a transaction with this payment method.
     *
     * @return string
     */
    public static function getInitiateUrl()
    {
        return '/transaction/sofort/initiate';
    }

    /**
     * Takes the default data for a purchase request and makes method-specific changes
     *
     * @param $data
     * @param $parameters
     * @return mixed
     */
    public function setPurchaseData($data, $parameters)
    {
        $data['customer']   = $parameters['customer'];
        $data['projectId']  = $parameters['projectId'];

        return $data;
    }
}