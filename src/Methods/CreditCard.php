<?php

namespace Omnipay\SpryngPayments\Methods;

use Omnipay\SpryngPayments\PaymentMethod;

class CreditCard implements PaymentMethod
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
            'card',
            'customerIp',
            'dynamicDescriptor',
            'merchantReference',
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
        return '/transaction';
    }
}