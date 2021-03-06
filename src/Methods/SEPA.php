<?php

namespace Omnipay\SpryngPayments\Methods;

use Omnipay\SpryngPayments\PaymentMethod;
use Omnipay\SpryngPayments\Support\DoesNotSupportRefunds;

class SEPA implements PaymentMethod
{

    use DoesNotSupportRefunds;

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
            'customerReference',
            'customerIp',
            'dynamicDescriptor',
            'merchantReference',
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
        return '/transaction/sepa/initiate';
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
        $data['details']['redirect_url'] = $parameters['returnUrl'];
        $data['customer'] = $parameters['customerReference'];

        return $data;
    }
}