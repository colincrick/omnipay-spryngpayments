<?php

namespace Omnipay\SpryngPayments\Methods;

use Omnipay\SpryngPayments\PaymentMethod;
use Omnipay\SpryngPayments\Support\StandardRefund;

class Paypal implements PaymentMethod
{
    use StandardRefund;

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
        return '/transaction/paypal/initiate';
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
        $data['details']['capture_now'] = $parameters['capture'];
        $data['details']['redirect_url'] = $parameters['returnUrl'];
        unset($data['capture']);

        return $data;
    }

    /**
     * Get the URL to refund a transaction
     *
     * @param $transactionReference
     * @return mixed
     */
    public static function getRefundUrl($transactionReference)
    {
        return '/transaction/'.$transactionReference.'/paypal/paypal/refund';
    }
}